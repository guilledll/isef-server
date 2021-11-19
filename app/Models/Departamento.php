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

  /** Departamento -> Deposito (1:N)
   */
  public function depositos()
  {
    return $this->hasMany(Deposito::class);
  }
  /** Departamento -> Usuario (1:N)
   */
  public function users()
  {
    return $this->hasMany(User::class);
  }
}
