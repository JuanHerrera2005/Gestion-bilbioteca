<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table = 'donaciones';
    protected $primaryKey = 'donacion_id';
    protected $fillable = [
        'usuario_id', 'libro_id', 'fecha_donacion', 'descripcion', 'estado'
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
    
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }
}
