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
    'departamento_id'
  ];

  public function users()
  {
    return $this->hasMany(User::class);
  }
}
