<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
  use PasswordValidationRules;

  /**
   * Valida y crea un usuario.
   *
   * @param  array  $input
   * @return \App\Models\User
   */
  public function create(array $input)
  {
    Validator::make($input, [
      'ci' => ['required', 'integer', 'min:8', 'max:8', 'unique:users,ci'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
      'nombre' => ['required', 'string', 'max:50'],
      'apellido' => ['required', 'string', 'max:50'],
      'departamento' => ['required', 'integer', 'exists:departamento,id'],
      'telefono' => ['required', 'integer', 'min:6', 'max:9'],
      'password' => $this->passwordRules(),
    ])->validate();

    return User::create([
      'ci' => $input['ci'],
      'nombre' => $input['nombre'],
      'apellido' => $input['apellido'],
      'email' => $input['email'],
      'departamento' => $input['departamento'],
      'telefono' => $input['telefono'],
      'password' => Hash::make($input['password']),
      'rol' => 1, // 1 => Usuario // 2 => Guardia // 3 => Admin
    ]);
  }
}
