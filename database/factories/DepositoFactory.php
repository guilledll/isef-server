<?php

namespace Database\Factories;

use App\Models\Deposito;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepositoFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Deposito::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'departamento_id' => rand(1, 17),
      'nombre' => $this->faker->city(),
    ];
  }
}
