<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'generos';
    protected $primaryKey = 'genero_id';
    protected $fillable = [
        'nombre', 'descripcion', 'popularidad'
    ];
    
    public function libros()
    {
        return $this->hasMany(Libro::class, 'genero_id');
    }
}
