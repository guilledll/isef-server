<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
  use HasFactory;

  public $timestamps = false;

  protected $fillable = [
    'nombre',
  ];

  /** Departamento(id)->Deposito(departamento_id) (1:N)
   */
  public function deposito()
  {
    return $this->hasMany(Deposito::class);
  }
  /** Departamento(id)->Usuario(usuario) (1:N)
   */
  public function usuario()
  {
    return $this->hasMany(Usuario::class);
  }
}
