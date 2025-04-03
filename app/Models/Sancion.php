<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    protected $table = 'sanciones';
    protected $primaryKey = 'sancion_id';
    protected $fillable = [
        'usuario_id', 'fecha_inicio', 'fecha_fin', 'motivo',
        'tipo_sancion', 'multa', 'comentarios'
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
