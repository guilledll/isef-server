<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class   UserController extends Controller
{
  /**
   * Muestra todos los usuarios
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return UserResource::collection(User::with('departamento')->get());
  }

  /**
   * Muestra un usuario especifico
   *
   * @param  User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    return new UserResource($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  public function updateRol(Request $request, $ci)
  {
    $usuario = User::findOrFail($ci);
    $usuario->update([
      'rol' => $request->rol
    ]);

    return response()->json(['message' => 'Rol modificado con éxito!'], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($ci)
  {
    $usuario = User::findOrFail($ci);
    $usuario->delete();

    return response()->json(['message' => 'Usuario eliminado con éxito!'], 200);
  }
}
