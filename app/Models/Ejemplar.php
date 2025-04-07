<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    protected $table = 'ejemplares';
    protected $primaryKey = 'ejemplar_id';
    protected $fillable = [
        'libro_id', 'codigo_inventario', 'estado', 'ubicacion',
        'fecha_adquisicion', 'proveedor', 'condicion'
    ];
    
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id'); // Asegúrate de que 'libro_id' sea el nombre correcto de la columna
    }
    
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'ejemplar_id');
    }
}
