<?php

namespace Database\Factories;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class InventarioFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Inventario::class;


  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $user = DB::table('users')->inRandomOrder()->first();

    return [
      'user_ci' => $user->ci,
      'material_id' => rand(1, 100),
      'deposito_id' => rand(1, 30),
      'cantidad' => rand(-10, 10),
      'accion' => rand(0, 1),
      'fecha' => $this->faker->dateTimeBetween('-2 months')
    ];
  }
}
