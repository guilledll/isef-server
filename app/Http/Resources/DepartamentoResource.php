<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentoResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $users_count = isset($this->resource->users_count);
    $depositos_count = isset($this->resource->depositos_count);

    return [
      'id' => $this->id,
      'nombre' => $this->nombre,
      'users_count' => $this->when($users_count, $this->users_count),
      'depositos_count' => $this->when($depositos_count, $this->depositos_count),
    ];
  }
}
