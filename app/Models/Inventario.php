<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'user_ci',
    'cantidad',
    'accion',
    'fecha'
  ];

  protected $casts = [
    'fecha' => 'datetime',
  ];

  /**  Inventario -> Materiales (1:1) */
  public function material()
  {
    return $this->hasOne(Material::class);
  }

  /**  Inventario -> User (1:1) */
  public function user()
  {
    return $this->hasOne(User::class, "ci", "user_ci");
  }
}
