<?php

namespace App\Http\Controllers\API;

use App\Models\Departamento;
use App\Http\Controllers\Controller;
use App\Http\Requests\Departamento\StoreDepartamentoRequest;
use App\Http\Resources\DepartamentoResource;
use App\Models\Deposito;
use App\Models\User;

class DepartamentoController extends Controller
{
  /**
   * Asigna la respectiva "Policy" a cada función:
   * 
   * @return \App\Policies\DepartamentoPolicy 
   */
  public function __construct()
  {
    $this->authorizeResource(Departamento::class, 'departamento');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return DepartamentoResource::collection(
      Departamento::withCount('users')
        ->withCount('depositos')
        ->orderBy('users_count', 'desc')
        ->get()
    );
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

    return response()->json($departamento);
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

  /**
   * Devuelve los depositos de ese departamento
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function depositos($id)
  {
    $depositos = Deposito::where('departamento_id', $id)
      ->withCount('materiales')
      ->get();

    return response()->json($depositos);
  }

  /**
   * Devuelve los usuarios de ese departamento
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function usuarios($id)
  {
    $usuarios = User::where('departamento_id', $id)
      ->select('nombre', 'apellido', 'ci', 'telefono')
      ->get();

    return response()->json($usuarios);
  }
}
