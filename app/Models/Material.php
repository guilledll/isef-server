<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
  public $table = "materiales";
  public $timestamps = false;
  use HasFactory;

  protected $fillable = [
    'nombre',
    'categoria_id',
    'cantidad',
    'deposito_id'
  ];

  /**Material -> Deposito (1:1) */
  public function deposito()
  {
    return $this->belongsTo(Deposito::class);
  }
  /**Material -> Categoria (1:1) */
  public function categoria()
  {
    return $this->hasOne(Categoria::class, "id", "categoria_id");
  }
  /**  Material -> Inventario (1:1) */
  public function inventario()
  {
    return $this->belongsTo(Inventario::class);
  }
}
