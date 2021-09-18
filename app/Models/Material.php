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
        'cantidad',
    ];

    public function Deposito()
    {
        return $this->belongsTo('App\Models\Deposito');
    }
    public function Categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}
