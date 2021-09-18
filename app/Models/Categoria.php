<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];

    /** Categoría(id)->Materiales(categoria_id) (1:N)
     * Obtiene los materiales de esta categoria. */
    public function Material()
    {
        return $this->hasMany(Material::class);
    }

}
