<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
      'ci' => $this->ci,
      'nombre' => $this->nombre,
      'apellido' => $this->apellido,
      'correo' => $this->correo,
      'telefono' => $this->telefono,
      'departamento_id' => $this->departamento_id,
      'rol' => $this->rol,
      'departamento' => $this->departamento->nombre
    ];
  }
}
