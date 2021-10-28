<?php

namespace App\Http\Controllers\API;

use App\Models\Material;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Resources\InventarioResource;
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
    return MaterialResource::collection(Material::with('deposito', 'categoria')->get());
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
      $inventario->accion = 1;
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
  public function update(Request $request, Material $material)
  {

    $material = Material::findOrFail($request->id);

    //Agrega a inventario
    if ($material->cantidad < $request->cantidad) {

      $inventario = new Inventario();
      $inventario->material_id = $request->id;
      $inventario->user_ci = $request->usuario_ci;
      $inventario->cantidad = abs($material->cantidad - $request->cantidad);
      $inventario->deposito_id = $request->deposito_id;
      $inventario->accion = 1;
      $inventario->fecha = now();
      $inventario->save();
    } else {

      $inventario = new Inventario();
      $inventario->material_id = $request->id;
      $inventario->user_ci = $request->usuario_ci;
      $inventario->deposito_id = $request->deposito_id;
      $inventario->cantidad = ($material->cantidad - $request->cantidad);
      $inventario->accion = 0;
      $inventario->fecha = now();
      $inventario->save();
    }
    //Actualiza material
    $material->update([
      'nombre' => $request->nombre,
      'deposito_id' => $request->deposito_id,
      'categoria_id' => $request->categoria_id,
      'cantidad' => $request->cantidad,
    ]);

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
    //$this->authorize('delete', $material);
    Material::findOrFail($id)->delete();
    //$id->delete();
    //return response()->json($material->delete());
    return response()->json(['message' => 'Material eliminado con éxito!'], 200);
  }
  /**
   * Devuelve los movimientos de ese material
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function movimientos($id)
  {
    $movimientos = Inventario::where('material_id', $id)
      //  ->with(['deposito', 'material'])
      ->orderBy('fecha', 'asc')
      ->get();

    return InventarioResource::collection($movimientos);
  }
}
