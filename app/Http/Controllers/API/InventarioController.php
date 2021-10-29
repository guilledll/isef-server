<?php

namespace App\Http\Controllers\API;

use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Http\Resources\InventarioResource;
use Illuminate\Routing\Controller;

class InventarioController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return InventarioResource::collection(Inventario::with(['deposito', 'material'])->orderBy('fecha', 'DESC')->get());
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Inventario  $inventario
   * @return \Illuminate\Http\Response
   */
  public function show(Inventario $inventario)
  {
    return new InventarioResource($inventario);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Inventario  $inventario
   * @return \Illuminate\Http\Response
   */
  public function edit(Inventario $inventario)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Inventario  $inventario
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Inventario $inventario)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Inventario  $inventario
   * @return \Illuminate\Http\Response
   */
  public function destroy(Inventario $inventario)
  {
    //
  }
}
