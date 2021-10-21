<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $primaryKey = 'ci';
  public $incrementing = false;

  protected $fillable = [
    'ci',
    'nombre',
    'apellido',
    'correo',
    'password',
    'telefono',
    'departamento_id',
    'rol'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function departamento()
  {
    return $this->belongsTo(Departamento::class);
  }

  /**  User -> Inventario (1:1) */
  public function inventario()
  {
    return $this->hasMany(Inventario::class, "user_ci", "ci");
  }
}
