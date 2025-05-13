<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'autor_id';
    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'nacionalidad',
        'ciudad_natal', 'fecha_nacimiento', 'fecha_fallecimiento', 'biografia',
        'premios', 'genero_literario', 'redes_sociales', 'email', 'sitio_web'
    ];
    
    public function libros()
    {
        return $this->hasMany(Libro::class, 'autor_id');
    }



    
}
