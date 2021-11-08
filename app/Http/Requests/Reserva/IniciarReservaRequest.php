<?php

namespace App\Http\Requests\Reserva;

use App\Rules\VerificarDepositoEnDepartamento;
use Illuminate\Foundation\Http\FormRequest;

class IniciarReservaRequest extends FormRequest
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
      'departamento_id' => ['required', 'integer'],
      'deposito_id' => ['required', 'integer', new VerificarDepositoEnDepartamento($dep)],
      'inicio' => ['required', 'date', 'different:fin'],
      'fin' => ['required', 'date', 'different:inicio', 'after:inicio'],
    ];
  }
}
