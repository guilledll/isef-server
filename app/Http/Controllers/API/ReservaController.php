<?php

namespace App\Http\Controllers\API;

use App\Models\Reserva;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MaterialesReservados;
use App\Http\Resources\ReservaResource;
use App\Http\Resources\MaterialResource;
use App\Http\Requests\Reserva\StoreReservaRequest;
use App\Http\Requests\Reserva\IniciarReservaRequest;

class ReservaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ReservaResource::collection(Reserva::with('deposito', 'usuario')->get());
  }

  /**
   * Devuelve los materiales disponibles para la reserva
   *
   * @return \Illuminate\Http\Response
   */
  public function iniciar(IniciarReservaRequest $request)
  {
    // Todas las reservas que entren en el horarios indicado

    // De esas reservas todos los materiales reservados

    // Sumo todos los materiales reservados

    // Voy a buscar a la BD los mismos materiales que encontre reservados

    // Comparo el total de cada uno vs. los que estan reservados

    // Si la diff > 0 devuelvo ese material disponible

    $materiales = Material::where('deposito_id', $request->deposito_id)
      ->with(['deposito', 'categoria'])
      ->get();

    return MaterialResource::collection($materiales);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreReservaRequest $request)
  {
    $reserva = Reserva::create([
      'user_ci' => $request->user_ci,
      'inicio' => $request->inicio,
      'fin' => $request->fin,
      'deposito_id' => $request->deposito_id,
      'lugar' => $request->lugar,
      'razon' => $request->razon,
      'estado' => $request->validar ? 1 : 2,
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

    return response()->json(['message' => 'Reserva realizada con éxito!']);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $reserva = Reserva::find($id);
    $materialesReservados = MaterialesReservados::where('reserva_id', $reserva->id)->with('material')->get();

    $materiales = array();

    foreach ($materialesReservados as $material) {
      $mat['nombre'] = $material->material->nombre;
      $mat['id'] = $material->id;
      $mat['material_id'] = $material->material_id;
      $mat['cantidad'] = $material->cantidad;
      $mat['reserva_id'] = $material->reserva_id;
      array_push($materiales, $mat);
    }

    return response()->json([
      'reserva' => new ReservaResource($reserva),
      'materiales' => $materiales
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Reserva  $reserva
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Reserva $reserva)
  {
    //
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
