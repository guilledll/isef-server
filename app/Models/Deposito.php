<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'departamento_id'
    ];
    /** Relación Depósitos -> Departamento (N:1) */
    public function Departamento()
    {
        return $this->belongsTo('App\Models\Departamento');
    }
}
