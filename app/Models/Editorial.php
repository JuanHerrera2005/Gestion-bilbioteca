<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{


    protected $table = 'editoriales';
    protected $primaryKey = 'editorial_id';
    protected $fillable = [
        'nombre', 'pais', 'ciudad', 'fundador', 'ano_fundacion',
        'sitio_web', 'contacto_email', 'contacto_telefono'
    ];
    
    public function libros()
    {
        return $this->hasMany(Libro::class, 'editorial_id');
    }
}
