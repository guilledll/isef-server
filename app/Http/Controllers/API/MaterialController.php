<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Material;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Requests\StoreMaterialRequest;

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
      $material->deposito_id = $data['deposito_id'];
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
    /*
      $material = new Material();
      $material->nombre = $request->materiales;
      $material->deposito_id = $request->deposito_id;
      $material->categoria_id = $request->categoria_id;
      $material->cantidad = $request->cantidad;
      $material->save();

      //Agregar al inventario.
      $inventario = new Inventario();
      $inventario->user_ci = $request->user()->ci;
      $inventario->cantidad = $request->cantidad;
      $inventario->accion = "Alta";
      $inventario->fecha = now();
      $material->Inventario()->save($inventario);
    */
    return response()->json(['message' => 'Material agregado con éxito!'], 200);
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
  public function update(Request $request, Material $material)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Material  $material
   * @return \Illuminate\Http\Response
   */
  public function destroy(Material $material)
  {
    $this->authorize('delete', $material);

    return response()->json($material->delete());
  }
}
