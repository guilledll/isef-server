<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MaterialesPerdidos extends Model
{
  public $timestamps = false;

  protected $casts = [
    'fecha' => 'datetime',
  ];

  use HasFactory;
  /**  MaterialesPerdidos -> Reserva (1:1) */
  public function reserva()
  {
    return $this->belongsTo(Reserva::class);
  }
}
