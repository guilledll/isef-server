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
        'deposito_id',
        'categoria_id',
        'cantidad',
    ];

    public function Material()
    {
        return $this->belongsTo('App\Models\Departamento');
    }
}
