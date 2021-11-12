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
      'guardia_ci' => $this->guardia_ci,
      'deposito_id' => $this->deposito_id,
      'inicio' => $this->inicio,
      'fin' => $this->fin,
      'lugar' => $this->lugar,
      'razon' => $this->razon,
      'estado' => $this->estado,
      'nota_guardia' => $this->nota_guardia,
      'nota_usuario' => $this->nota_usuario,
      'user' => $this->usuario->nombre,
      'deposito' => $this->deposito->nombre,
      'cantidad_reservas' => intval($this->cantidad_reservas),
    ];
  }
}
