<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Deposito;
use App\Models\Categoria;
use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $dep = Departamento::factory()->create();
    User::factory()->count(10)->for($dep)->create();


/*
    $deposito = Deposito::factory()->create();
    User::factory()->count(10)->for($deposito)->create();
    $categoria = Categoria::factory()->create();
    Categoria::factory()->count(10)->for($categoria)->create();
*/
  }
}
