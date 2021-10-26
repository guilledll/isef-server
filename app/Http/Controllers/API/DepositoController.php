<?php

namespace App\Http\Controllers\API;

use App\Models\Deposito;
use App\Http\Controllers\Controller;
use App\Http\Requests\Deposito\StoreDepositoRequest;
use App\Http\Resources\DepositoResource;
use App\Http\Resources\MaterialResource;
use App\Models\Material;

class DepositoController extends Controller
{
  /**
   * Asigna la respectiva "Policy" a cada función:
   *
   * @return \App\Policies\DepositoPolicy
   */
  public function __construct()
  {
    $this->authorizeResource(Deposito::class, 'deposito');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return DepositoResource::collection(
      Deposito::withSum('materiales as cantidad_materiales', 'cantidad')
        ->with('departamento')
        ->get()
    );
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\Deposito\StoreDepositoRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreDepositoRequest $request)
  {
    $deposito = new Deposito();
    $deposito->nombre = $request->nombre;
    $deposito->departamento_id = $request->departamento_id;
    $deposito->save();

    return response($deposito);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Deposito  $deposito
   * @return \Illuminate\Http\Response
   */
  public function show(Deposito $deposito)
  {
    return new DepositoResource($deposito);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\StoreDepositoRequest  $request
   * @param  \App\Models\Departamento  $deposito
   * @return \Illuminate\Http\Response
   */
  public function update(StoreDepositoRequest $request, Deposito $deposito)
  {
    $deposito->update([
      'nombre' => $request->nombre
    ]);

    return response()->json($deposito);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function destroy(Deposito $deposito)
  {
    $deposito->loadSum('materiales', 'cantidad');

    if ($deposito->materiales_sum_cantidad) {
      return response()->json(['message' => 'El depósito contiene materiales'], 422);
    }

    $deposito->delete();

    return response()->json(['message' => 'Depósito eliminado con éxito!'], 200);
  }

  /**
   * Devuelve los materiales de ese deposito
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function materiales($id)
  {
    $materiales = Material::where('deposito_id', $id)
      ->with('categoria')
      ->orderBy('nombre', 'asc')
      ->get();

    return MaterialResource::collection($materiales);
    // return response()->json($materiales);
  }
}
