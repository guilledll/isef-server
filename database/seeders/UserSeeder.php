<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $arr = array(
      ['50656233', 'Guillermo', 'De León', 'guilledll20@gmail.com', '095189646'],
      ['12345678', 'Joaquin', 'Gomez', 'joaco@gmail.com', '093124211']
    );

    foreach ($arr as list($ci, $nom, $ape, $correo, $tel)) {
      User::create([
        'ci' => $ci,
        'nombre' => $nom,
        'apellido' => $ape,
        'correo' => $correo,
        'departamento_id' => 1,
        'telefono' => $tel,
        'rol' => 3,
        'password' => Hash::make('12345678'),
        'email_verified_at' => now(),
      ]);
    }
  }
}
