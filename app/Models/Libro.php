<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public $timestamps = false;
    protected $table = 'libros';
    protected $primaryKey = 'libro_id';
    protected $fillable = [
        'titulo', 'imagen', 'autor_id', 'editorial_id', 'genero_id',
        'anio_publicacion', 'isbn', 'numero_paginas', 'idioma', 'resumen',
        'formato', 'edicion', 'disponibilidad','estado_auditoria'
    ];
    
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }
    
    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }
    
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }
    
    public function ejemplares()
    {
        return $this->hasMany(Ejemplar::class, 'libro_id');
    }

    protected $attributes = [
        'estado_auditoria' => '1' // Valor por defecto
    ];

        // Scope para filtrar libros activos
        public function scopeActivos($query)
        {
            return $query->where('estado_auditoria', '1');
        }

    
}
