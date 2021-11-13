<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'user_ci' => $this->user_ci,
      'user' => $this->usuario->nombre . ' ' . $this->usuario->apellido,
      'guardia_ci' => $this->guardia_ci,
      'deposito_id' => $this->deposito_id,
      'deposito' => $this->deposito->nombre,
      'inicio' => $this->inicio,
      'fin' => $this->fin,
      'lugar' => $this->lugar,
      'razon' => $this->razon,
      'estado' => $this->estado,
      'nota_guardia' => $this->nota_guardia,
      'nota_usuario' => $this->nota_usuario,
    ];
  }
}
