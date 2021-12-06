<?php

namespace App\Http\Controllers;

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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $materialPerdido = new MaterialesPerdidos();
    $materialPerdido->nota = $request->nota;
    $materialPerdido->reportador_ci = $request->reportador_ci;
    $materialPerdido->reserva_id = 1; //$request->reserva_ci;
    $materialPerdido->deposito_id = $request->deposito_id;
    $materialPerdido->fecha = now();
    $materialPerdido->save();

    return response($materialPerdido);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\MaterialesPerdidos  $materialesPerdidos
   * @return \Illuminate\Http\Response
   */
  public function show(MaterialesPerdidos $materialesPerdidos)
  {
    //return new MaterialesPerdidosResource($inventario);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\MaterialesPerdidos  $materialesPerdidos
   * @return \Illuminate\Http\Response
   */
  public function edit(MaterialesPerdidos $materialesPerdidos)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\MaterialesPerdidos  $materialesPerdidos
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, MaterialesPerdidos $materialesPerdidos)
  {
    //
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
