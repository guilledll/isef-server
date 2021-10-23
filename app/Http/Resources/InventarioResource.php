<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventarioResource extends JsonResource
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
      //'material_id' => $this->material->nombre,
      'material' => $this->material->nombre,
      'user_ci' => $this->user_ci,
      'cantidad' => $this->cantidad,
      'accion' => $this->accion,
      'fecha' => $this->fecha->format('d-m-Y'),
      'deposito' => $this->deposito->nombre,
      //'fecha' => $this->fecha->format('d-m-Y H:i'),
    ];
  }
}
