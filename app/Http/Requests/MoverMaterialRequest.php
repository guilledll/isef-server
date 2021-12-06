<?php

namespace App\Http\Requests;

use App\Rules\VerificarDepositoEnDepartamento;
use Illuminate\Foundation\Http\FormRequest;

class MoverMaterialRequest extends FormRequest
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
      'id' => ['required', 'integer'],
      'usuario_ci' => ['required', 'integer', 'exists:users,ci'],
      'deposito_destino_id' => ['required', 'integer', new VerificarDepositoEnDepartamento($dep)],
      'deposito_origen_id' => ['required', 'integer', 'exists:depositos,id'],
      'cantidad' => ['required', 'numeric', 'min:1'],
      'nota' => ['string', 'max:255', 'nullable'],
    ];
  }
}
