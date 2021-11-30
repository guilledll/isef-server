<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Mail\UsuarioAprobadoMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class   UserController extends Controller
{
  /**
   * Muestra todos los usuarios
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return UserResource::collection(
      User::with('departamento')
        ->orderBy('rol', 'asc')
        ->get()
    );
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
  public function update(UpdateUserRequest $request, User $user)
  {
    $user->update([
      'nombre' => $request->nombre,
      'apellido' => $request->apellido,
      'telefono' => $request->telefono,
      'departamento_id' => $request->departamento_id,
      'correo' => $request->correo,
    ]);

    return response()->json(['message' => 'Usuario modificado con éxito!']);
  }

  /**
   * Actualiza el rol de un usuario
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateRol(Request $request, User $user)
  {
    $rolAnterior = $user->rol;

    $user->update([
      'rol' => $request->rol
    ]);

    if ($request->rol != 0 && $rolAnterior == 0) {
      Mail::to($user->correo)
        ->send((new UsuarioAprobadoMail($user, url(env('SPA_URL') . '/login')))
            ->subject('Acceso validado')
        );
    }

    return new UserResource($user);
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
