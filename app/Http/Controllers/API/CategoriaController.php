<?php

namespace App\Http\Controllers\API;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Resources\CategoriaResource;

class CategoriaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CategoriaResource::collection(
      Categoria::withSum('material as cantidad_materiales', 'cantidad')->get()
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

    return response()->json(['message' => 'Categoría registrada con éxito!'], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Categoria  $categoria
   * @return \Illuminate\Http\Response
   */
  public function show(Categoria $departamento)
  {
    //
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

    return response()->json(['message' => 'Categoría modificada con éxito!'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Categoria  $departamento
   * @return \Illuminate\Http\Response
   */
  public function destroy(Categoria $categoria)
  {
    //
  }
}
