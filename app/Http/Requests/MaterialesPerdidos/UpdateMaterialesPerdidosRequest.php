<?php

namespace App\Http\Requests\MaterialesPerdidos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialesPerdidosRequest extends FormRequest
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
      'resuelto' => ['boolean'],
      'admin_ci' => ['required_with:resuelto', 'exists:users,ci'],
      'nota_admin' => ['required:resuelto', 'max:500', 'min:10'],
    ];
  }
}
