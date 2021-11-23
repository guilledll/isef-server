<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialesPerdidosResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'reserva_id' => $this->reserva_id,
      'guardia_ci' => $this->guardia_ci,
      'admin_ci' => $this->admin_ci,
      'nota_guardia' => $this->nota_guardia,
      'nota_admin' => $this->nota_admin,
      'accion_tomada' => $this->accion_tomada,
      'fecha' => $this->fecha,
    ];
  }
}
