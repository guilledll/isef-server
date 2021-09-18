<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function Categoria()
    {
        return $this->belongsTo('App\Models\Departamento');
    }
}
