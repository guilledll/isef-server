<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialesPerdidos\UpdateMaterialesPerdidosRequest;
use App\Http\Resources\MaterialesPerdidosResource;
use App\Models\MaterialesPerdidos;
use Illuminate\Http\Request;

class MaterialesPerdidosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return MaterialesPerdidosResource::collection(MaterialesPerdidos::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(MaterialesPerdidos $materialesPerdido)
  {
    return new MaterialesPerdidosResource($materialesPerdido);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\MaterialesPerdidos  $materialesPerdidos
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateMaterialesPerdidosRequest $request, MaterialesPerdidos $materialesPerdido)
  {
    $materialesPerdido->update([
      'admin_ci' => $request->admin_ci,
      'nota_admin' => $request->nota_admin,
      'accion_tomada' => true,
    ]);

    return response()->json(['message' => 'Accion registrada.']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\MaterialesPerdidos  $materialesPerdidos
   * @return \Illuminate\Http\Response
   */
  public function destroy(MaterialesPerdidos $materialesPerdidos)
  {
    //
  }
}
