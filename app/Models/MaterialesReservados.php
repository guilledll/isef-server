<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialesReservados extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'material_id',
    'cantidad',
  ];

  /**  MaterialReservado -> Material (1:1) */
  public function material()
  {
    return $this->belongsTo(Material::class);
  }
  /**  MaterialReservado -> Reserva (1:1) */
  public function reserva()
  {
    return $this->belongsTo(Reserva::class);
  }
}
