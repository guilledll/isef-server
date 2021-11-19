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
      'reportador_ci' => $this->reportador_ci,
      'reserva_id' => $this->reserva_id,
      'nota' => $this->nota,
      'fecha' => $this->fecha,
    ];
  }
}
