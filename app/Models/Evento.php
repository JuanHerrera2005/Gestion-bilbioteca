<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'evento_id';
    protected $fillable = [
        'nombre', 'descripcion', 'fecha_inicio', 'fecha_fin',
        'ubicacion', 'organizador', 'estado'
    ];
}
