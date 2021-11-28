<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $arr = array(
      'Maldonado', 'Rocha'
    );

    foreach ($arr as $nom) {
      Departamento::create([
        'nombre' => $nom
      ]);
    }
  }
}
