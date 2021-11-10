<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositoResource extends JsonResource
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
      'nombre' => $this->nombre,
      'departamento_id' => $this->departamento_id,
      'departamento' => $this->departamento->nombre,
      'cantidad_materiales' => intval($this->cantidad_materiales),
      'reservas_count' => intval($this->reservas_count),
    ];
  }
}
