<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
    $user = $this->input('ci');

    return [
      'correo' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user, 'ci')],
      'nombre' => ['required', 'string', 'max:50'],
      'apellido' => ['required', 'string', 'max:50'],
      'password' => ['required', 'string', 'max:50', 'min:8'],
      'departamento_id' => ['required', 'integer', 'exists:departamentos,id'],
      'telefono' => ['required', 'string', 'size:9', Rule::unique('users')->ignore($user, 'ci')],
    ];
  }
}
