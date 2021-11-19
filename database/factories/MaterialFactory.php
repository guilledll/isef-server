<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Material::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'nombre' => $this->faker->words(rand(1, 3), true),
      'deposito_id' => rand(1, 20),
      'categoria_id' => rand(1, 12),
      'cantidad' => rand(0, 25),
    ];
  }
}
