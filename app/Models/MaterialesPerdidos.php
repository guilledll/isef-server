<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MaterialesPerdidos extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'reserva_id',
    'guardia_ci',
    'admin_ci',
    'materiales',
    'nota_guardia',
    'nota_admin',
    'accion_tomada',
    'fecha',
  ];

  protected $casts = [
    'fecha' => 'datetime',
  ];

  /**  MaterialesPerdidos -> Reserva (1:1) */
  public function reserva()
  {
    return $this->belongsTo(Reserva::class);
  }

  /**  MaterialesPerdidos -> Guardia (1:1) */
  public function guardia()
  {
    return $this->belongsTo(User::class, 'guardia_ci', 'ci');
  }

  /**  MaterialesPerdidos -> Guardia (1:1) */
  public function admin()
  {
    return $this->hasOne(User::class, 'admin_ci', 'ci');
  }
}
