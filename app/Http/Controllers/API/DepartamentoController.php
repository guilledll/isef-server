<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartamentoResource;
use App\Models\Departamento;
use Illuminate\Http\Request;

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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function show(Departamento $departamento)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Departamento $departamento)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Departamento  $departamento
   * @return \Illuminate\Http\Response
   */
  public function destroy(Departamento $departamento)
  {
    //
  }
}
