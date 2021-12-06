<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reserva\IniciarReservaRequest;
use App\Http\Requests\Reserva\StoreReservaRequest;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\ReservaResource;
use App\Mail\AccionReservaMail;
use App\Mail\ReservaPendienteMail;
use App\Models\Material;
use App\Models\MaterialesPerdidos;
use App\Models\MaterialesReservados;
use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReservaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ReservaResource::collection(
      Reserva::with('deposito', 'usuario', 'materialesPerdidos')
        ->orderBy('estado')->get()
    );
  }
  /**
   * Devuelve los materiales disponibles para la reserva
   *
   * @return \Illuminate\Http\Response
   */
  //devuelve los materiales disponibles.
  public function iniciar(IniciarReservaRequest $request)
  {
    $inicio = new Carbon($request->inicio);
    $fin = new Carbon($request->fin);

    // Todas las reservas que entren en el horario indicado
    $reservas = Reserva::where('deposito_id', $request->deposito_id)
      ->whereNotIn('estado', [4, 5])
      ->where(
        fn ($query) => $query->where('fin', '>', $inicio)
          ->where('inicio', '<', $inicio)
      )->orWhere(
        fn ($query) => $query->where('inicio', '>=', $inicio)
          ->where('inicio', '<', $fin)
      )
      ->with('materiales')
      ->get();

    // matOcupados = Los materiales que esten siendo usados
    // matDisponibles = Los materiales disponibles para el usuario
    // matIDs = ID de los materiales ocupados

    $matOcupados = $matDisponibles = $matIDs = array();

    // De esas reservas todos los materiales reservados
    foreach ($reservas as $reserva) {
      foreach ($reserva['materiales'] as $material) {
        // Si el material ya esta en el arreglo le sumo la nueva cantidad
        if (isset($matOcupados[$material->material_id])) {
          $matOcupados[$material->material_id]->cantidad += $material->cantidad;
        } else { // si no esta lo agrego
          $matOcupados[$material->material_id] = $material;
          array_push($matIDs, $material->material_id);
        }
      }
    }

    // Busco los materiales que encontre reservados
    $materialesReservados = Material::whereIn('id', $matIDs)
      ->with(['deposito', 'categoria'])
      ->get();

    // Verifico que la diferencia de cantidades entre los utilizados
    // y los existentes sea > 0
    foreach ($materialesReservados as $mat) {
      if ($mat->cantidad - $matOcupados[$mat->id]->cantidad > 0) {
        // Resto lo ocupado
        $mat->cantidad -= $matOcupados[$mat->id]->cantidad;
        array_push($matDisponibles, $mat);
      };
    }

    // Los materiales que no estan reservados
    $matLibres = Material::whereNotIn('id', $matIDs)
      ->where('deposito_id', $request->deposito_id)
      ->with(['deposito', 'categoria'])
      ->get();

    // Combino el array de no utilizados con el de cantidad
    // disponible calculado antes
    $materiales = $matLibres->merge($matDisponibles);

    return MaterialResource::collection($materiales);
  }

  //Devuelve todas las reservas en el horario especificado
  public static function reservasEnHorario(StoreReservaRequest $request, $inicio, $fin)
  {
    $reserva = Reserva::where('deposito_id', $request->deposito_id)
      ->whereNotIn('estado', [4, 5])
      ->where(
        fn ($query) => $query->where('fin', '>', $inicio)
          ->where('inicio', '<', $inicio)
      )->orWhere(
        fn ($query) => $query->where('inicio', '>=', $inicio)
          ->where('inicio', '<', $fin)
      )
      ->with('materiales')
      ->get();

    return $reserva;
  }

  public static function findMaterialReserva($id, $materiales)
  {
    foreach ($materiales as $material) {
      if ($id == $material->id) {
        return $material;
      }
    }
  }

  //Recibe las reservas y retorna todos los materiales reservados.
  public static function materialesReservados($reservas, $materiales_interes)
  {
    $matOcupados = $matIDs = array();

    // De esas reservas todos los materiales reservados
    foreach ($reservas as $reserva) {
      foreach ($reserva['materiales'] as $material) {

        $m = self::findMaterialReserva($reservas, $materiales_interes);

        if ($m) {
          // Si el material ya esta en el arreglo le sumo la nueva cantidad
          if (isset($matOcupados[$material->material_id])) {
            $matOcupados[$material->material_id]->cantidad += $material->cantidad;
          } else { // si no está lo agrego
            $matOcupados[$material->material_id] = $material;
            array_push($matIDs, $material->material_id);
          }
        }
      }
    }
    // Busco los materiales que encontre reservados
    $materialesReservados = Material::whereIn('id', $matIDs)
      ->with(['deposito', 'categoria'])
      ->get();

    return $materialesReservados;
  }

  //Materiales que no estan reservados.
  public static function materialesDisponibles(StoreReservaRequest $request, $matIDs)
  {
    //Los materiales que no estan reservados
    $matLibres = Material::whereNotIn('id', $matIDs)
      ->where('deposito_id', $request->deposito_id)
      ->with(['deposito', 'categoria'])
      ->get();
    return $matLibres;
  }

  //Los ocupados que me interesan
  public static function verificarMaterialesDisp(StoreReservaRequest $request)
  {
    $inicio = new Carbon($request->inicio);
    $fin = new Carbon($request->fin);

    $reservas = self::reservasEnHorario($request, $inicio, $fin); //Obtengo las reservas.
    $materialesReservados = self::materialesReservados($reservas->materiales, $request->materiales); // Obtengo los materiales reservados que me interesan.
    if (isset($materialesReservados)) {
      return true;
    } else {
      return false;
    }
    //De los materiales que quiero, ver si hay disponibilidad (canditad: ok).
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreReservaRequest $request)
  {
    /*
    $nodisp = self::verificarMaterialesDisp($request);

    if ($nodisp) {
      return response()->json("material no disponible");
    }
    */
    $reserva = Reserva::create([
      'user_ci' => $request->user_ci,
      'inicio' => new Carbon($request->inicio),
      'fin' => new Carbon($request->fin),
      'deposito_id' => $request->deposito_id,
      'lugar' => $request->lugar,
      'razon' => $request->razon,
      'estado' => $request->validar ? 3 : 2,
      'nota_usuario' => $request->notas,
    ]);

    $materiales = array();

    foreach ($request->materiales as $material) {
      array_push($materiales, [
        'reserva_id' => $reserva->id,
        'material_id' => $material['id'],
        'cantidad' => $material['cantidad'],
      ]);
    }

    DB::table('materiales_reservados')->insert($materiales);

    $mensaje = ['message' => 'Reserva realizada con éxito!', 'pendiente' => false];

    // Si necesita ser aprobada
    if ($request->validar) {
      // Selecciono 5 admins al azar de ese departamento
      $admins = DB::table('users')->where([
        ['departamento_id', $request->departamento_id], ['rol', 3]
      ])->limit(1)->get('correo');

      foreach ($admins as $admin) {
        Mail::to($admin->correo)
          ->send(new ReservaPendienteMail(
            $request,
            url(env('SPA_URL') . '/reservas/' . $reserva->id)
          ));
      }
      $mensaje['pendiente'] = true;
    }

    return response()->json($mensaje);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function show(Reserva $reserva)
  {
    $materialesReservados = MaterialesReservados::where('reserva_id', $reserva->id)
      ->with('material')->get();

    $materiales = array();

    foreach ($materialesReservados as $material) {
      $mat['nombre'] = $material->material->nombre;
      $mat['id'] = $material->id;
      $mat['material_id'] = $material->material_id;
      $mat['cantidad'] = $material->cantidad;
      $mat['reserva_id'] = $material->reserva_id;
      array_push($materiales, $mat);
    }

    $materialesPerdidos = MaterialesPerdidos::where('reserva_id', $reserva->id)->select('id')->first();

    return response()->json([
      'reserva' => new ReservaResource($reserva),
      'materiales' => $materiales,
      'perdidos' => $materialesPerdidos,
    ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function getAllReservaUsuario($ci)
  {
    return ReservaResource::collection(
      Reserva::with('deposito', 'usuario')
        ->where('user_ci', $ci)
        ->orderBy('estado')
        ->get()
    );
  }

  /**
   * Entregar un reserva al usuario (como guardia).
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function entregar(Request $request, Reserva $reserva)
  {
    $reserva->update([
      'guardia_ci' => $request->guardia_ci,
      'estado' => 1,
    ]);

    return response()->json(['message' => 'Reserva entregada con éxito!']);
  }

  /**
   * Permite al usuario cancelar la reserva.
   *
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function cancelar(Reserva $reserva)
  {
    $reserva->update([
      'estado' => 5,
    ]);

    return response()->json(['message' => 'Reserva cancelada con éxito!']);
  }

  /**
   * Recibe un reserva del usuario (como guardia).
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function recibir(Request $request, Reserva $reserva)
  {
    $reserva->update([
      'nota_guardia' => $request->nota_guardia,
      'estado' => 4,
    ]);

    // Generar reporte si es necesario
    if ($request->problema) {
      // Si hay materiales perdidos los guardo
      $materiales_perdidos = ($request->perdidos)
        ? $request->materiales_perdidos
        : null;

      MaterialesPerdidos::create([
        'reserva_id' => $reserva->id,
        'guardia_ci' => $request->guardia_ci,
        'materiales' => $materiales_perdidos,
        'nota_guardia' => $request->nota_perdidos,
        'deposito_id' => $request->deposito_id,
        'fecha' => now(),
      ]);
    }
    return response()->json(['message' => 'Reserva recibida.']);
  }

  /**
   * Permite al admin cancelar o aprobar la reserva
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Reserva $reserva)
  {
    // Aprobada
    if ($request->estado == 2) {
      $estado = 'aprobada';
      $msg = 'Reserva aprobada con éxito!';
    }
    // Cancelada
    if ($request->estado == 5) {
      $estado = 'cancelada';
      $msg = 'Reserva cancelada con éxito!';
    }

    $reserva->update([
      'estado' => $request->estado,
    ]);

    $user = User::where('ci', $reserva->user_ci)->first();

    // Envia correo al usuario
    Mail::to($user->correo)
      ->send(
        (new AccionReservaMail($reserva, url(env('SPA_URL') . '/perfil/' . $user->ci), $estado))
          ->subject('Tu reserva fue ' . $estado)
      );

    return response()->json(['message' => $msg]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function destroy(Reserva $reserva)
  {
    //
  }
}
