<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'user_ci',
    'guardia_ci',
    'deposito_id',
    'inicio',
    'fin',
    'lugar',
    'razon',
    'estado',
    'nota_guardia',
    'nota_usuario',
  ];

  protected $casts = [
    'inicio' => 'datetime:Y-m-d H:i:s',
    'fin' => 'datetime:Y-m-d H:i:s',
  ];

  /** Reserva -> Usuario (1:1) */
  public function usuario()
  {
    return $this->belongsTo(User::class, 'user_ci', 'ci');
  }

  /** Reserva -> Usuario (1:1) */
  public function guardia()
  {
    return $this->hasOne(User::class, 'guardia_ci', 'ci');
  }

  /** Reserva -> deposito (1:1) */
  public function deposito()
  {
    return $this->belongsTo(Deposito::class);
  }

  /** Reserva -> Materiales (1:N) */
  public function materiales()
  {
    return $this->hasMany(MaterialesReservados::class);
  }
  /** Reserva -> materialesPerdidos (1:1) */
  public function materialesPerdidos()
  {
    return $this->hasOne(MaterialesPerdidos::class);
  }
}
