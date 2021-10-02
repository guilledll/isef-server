<?php

namespace App\Http\Requests;

use App\Rules\VerificarDeposito;
use Illuminate\Foundation\Http\FormRequest;

class StoreDepositoRequest extends FormRequest
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
    $dep = $this->input('departamento_id');

    return [
      'departamento_id' => ['required', 'integer', 'exists:departamentos,id'],
      'nombre' => ['required', new VerificarDeposito($dep)]
    ];
  }
}
