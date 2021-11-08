<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'nombre',
  ];

  /**  Depósitos -> Departamento (N:1) */
  public function departamento()
  {
    return $this->belongsTo(Departamento::class);
  }

  /**  Depósitos -> Materiales (1:N) */
  public function materiales()
  {
    return $this->hasMany(Material::class);
  }

  /**  Depósitos -> Reservas (1:N) */
  public function reservas()
  {
    return $this->hasMany(Reserva::class);
  }
}
