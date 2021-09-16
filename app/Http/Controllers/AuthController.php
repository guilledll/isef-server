<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  /**
   * Devuelve el usuario autenticado
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Http\Resources\UserResource;
   */
  public function __invoke(Request $request)
  {
    return new UserResource($request->user());
  }
}
