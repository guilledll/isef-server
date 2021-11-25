<?php

namespace App\Rules;

use App\Models\Categoria;
use Illuminate\Contracts\Validation\Rule;

class VerificarCategoria implements Rule
{
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    return Categoria::where(
      'nombre',
      $value
    )->doesntExist();
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'Ya existe una categoría con este nombre.';
  }
}
