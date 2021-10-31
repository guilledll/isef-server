<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
  public $table = "reservas";
  public $timestamps = false;
  use HasFactory;

  protected $fillable = [
    'lugar',
    'razon',
    'estado',
    'Notas_guardia'
  ];

  /**Reserva -> Usuario (1:1) */
  public function usuario()
  {
    return $this->belongsTo(User::class);
  }
}
