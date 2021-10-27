<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
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
      'deposito' => $this->deposito->nombre,
      'categoria' => $this->categoria->nombre,
      'categoria_id' => $this->categoria->id,
      'cantidad' => $this->cantidad,
    ];
  }
}
