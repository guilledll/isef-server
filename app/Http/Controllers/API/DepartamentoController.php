<?php

namespace App\Http\Controllers\API;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartamentoRequest;
use App\Http\Resources\DepartamentoResource;

class DepartamentoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return DepartamentoResource::collection(Departamento::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreDepartamentoRequest $request)
  {

    $departamento = new Departamento();
    $departamento->nombre = $request->nombre;
    $departamento->save();

    return response($departamento);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function show(Departamento $departamento)
  {
    return new DepartamentoResource($departamento);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function update(StoreDepartamentoRequest $request, Departamento $departamento)
  {
    $departamento->update([
      'nombre' => $request->nombre,
    ]);

    return response()->json(['message' => 'Departamento modificado con éxito!'], 200);
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function destroy(Departamento $departamento)
  {
    $departamento->delete();

    return response()->json(['message' => 'Departamento eliminado con éxito!'], 200);
  }
}
