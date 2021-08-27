<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
      'ci' => ['required', 'integer', 'numeric', 'min:8', 'max:8', Rule::unique(User::class, 'ci'),],
      'nombre' => ['required', 'string', 'max:50'],
      'apellido' => ['required', 'string', 'max:50'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
      'direccion' => ['required', 'string', 'max:150'],
      'telefono' => ['required', 'integer', 'numeric', 'min:6', 'max:9'],
      'password' => $this->passwordRules(),
    ])->validate();

    return User::create([
      'ci' => $input['ci'],
      'nombre' => $input['nombre'],
      'apellido' => $input['apellido'],
      'email' => $input['email'],
      'direccion' => $input['direccion'],
      'telefono' => $input['telefono'],
      'password' => Hash::make($input['password']),
      'rol' => 1, // 1 => Usuario // 2 => Guardia // 3 => Admin
    ]);
  }
}
