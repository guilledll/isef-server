<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Material;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Requests\Material\StoreMaterialRequest;

class MaterialController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return MaterialResource::collection(Material::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreMaterialRequest $request)
  {

    foreach ($request->materiales as $data) {

      $material = new Material();
      $material->nombre = $data['nombre'];
      $material->deposito_id = $request->deposito;
      $material->categoria_id = $data['categoria_id'];
      $material->cantidad = $data['cantidad'];

      $material->save();

      $inventario = new Inventario();
      $inventario->material_id = $material->id;
      $inventario->user_ci = $request->usuario_ci;
      $inventario->cantidad = $data['cantidad'];
      $inventario->accion = "Alta";
      $inventario->fecha = now();
      $inventario->save();
    }
    return response($material);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Material  $deposito
   * @return \Illuminate\Http\Response
   */
  public function show(Material $material)
  {
    return new MaterialResource($material);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Material  $material
   * @return \Illuminate\Http\Response
   */
  /*
  public function update(Request $request, Material $material)
  {
  }*/
  public function update(Request $request, $id)
  {
    Material::findOrFail($id)->update([
      'nombre' => $request->nombre,
      'categoria_id' => $request->categoria_id,
      'deposito_id' => $request->deposito_id,
      'cantidad' => $request->cantidad,
    ]);;

    return response()->json(['message' => 'Material modificado con éxito!'], 200);
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Material  $material
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    /* Los materiales registrados no se borran.
    Material::findOrFail($id)->delete();
    return response()->json(['message' => 'Material eliminado con éxito!'], 200);
    */
  }
}
