<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'nombre'
  ];

  /** Categoría -> Materiales (1:N) */
  public function materiales()
  {
    return $this->hasMany(Material::class);
  }
}
