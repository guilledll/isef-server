<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'cantidad'
    ];

    /**Material -> Deposito (1:1) */
    public function Deposito()
    {
        return $this->hasOne(Deposito::class);
    }
    /**Material -> Categoria (1:1) */
    public function Categoria()
    {
        return $this->hasOne(Categoria::class);
    }
}
