<?php

namespace App\Http\Requests\Material;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialesRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'usuario_ci' => ['required', 'integer', 'exists:users,ci'],
      'nombre' => ['required', 'max:50'],
      'cantidad' => ['required', 'numeric', 'min:0'],
      'nota' => ['string', 'max:255', 'nullable'],
    ];
  }
}
