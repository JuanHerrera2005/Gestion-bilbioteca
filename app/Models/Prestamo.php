<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $primaryKey = 'prestamo_id';
    protected $fillable = [
        'usuario_id', 'ejemplar_id', 'fecha_prestamo', 'fecha_devolucion',
        'estado', 'observaciones', 'metodo_entrega', 'multa_aplicada'
    ];
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
    
    public function ejemplar()
    {
        return $this->belongsTo(Ejemplar::class, 'ejemplar_id'); // Asegúrate de que 'ejemplar_id' sea el nombre correcto de la columna
    }

    // Desactivar el manejo automático de created_at y updated_at
    public $timestamps = false;
}
