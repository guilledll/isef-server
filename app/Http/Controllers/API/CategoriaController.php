<?php

namespace App\Http\Controllers\API;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\MaterialResource;
use App\Models\Material;

class CategoriaController extends Controller
{
  /**
   * Asigna la respectiva "Policy" a cada función:
   * 
   * @return \App\Policies\CategoriaPolicy 
   */
  public function __construct()
  {
    $this->authorizeResource(Categoria::class, 'categoria');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CategoriaResource::collection(
      Categoria::withSum('materiales as cantidad_materiales', 'cantidad')
        ->get()
    );
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCategoriaRequest $request)
  {
    $categoria = new Categoria();
    $categoria->nombre = $request->nombre;
    $categoria->save();

    return response($categoria);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Http\Response
   */
  public function show(Categoria $categoria)
  {
    return new CategoriaResource($categoria);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\StoreCategoriaRequest  $request
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Http\Response
   */
  public function update(StoreCategoriaRequest $request, Categoria $categoria)
  {
    $categoria->update([
      'nombre' => $request->nombre,
    ]);

    return response()->json($categoria);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Http\Response
   */
  public function destroy(Categoria $categoria)
  {
    $categoria->delete();

    return response()->json(['message' => 'Categoría eliminada con éxito!'], 200);
  }

  /**
   * Devuelve los materiales de esa categoria
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function materiales($id)
  {
    $materiales = Material::where('categoria_id', $id)
      ->with(['deposito', 'categoria'])
      ->orderBy('nombre', 'asc')
      ->get();

    return MaterialResource::collection($materiales);
  }
}
