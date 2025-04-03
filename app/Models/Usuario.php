<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';
    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'tipo_documento',
        'numero_documento', 'email', 'contrasena', 'telefono', 'direccion',
        'fecha_nacimiento', 'genero', 'ocupacion', 'estado_civil',
        'nacionalidad', 'nivel_educativo'
    ];
    
    protected $hidden = ['contrasena'];
    
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }
    
    public function sanciones()
    {
        return $this->hasMany(Sancion::class, 'usuario_id');
    }
}
