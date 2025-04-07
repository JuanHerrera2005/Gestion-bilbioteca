<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'usuario_id';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'tipo_documento',
        'numero_documento', 'email', 'contrasena', 'telefono', 'direccion',
        'fecha_nacimiento', 'genero', 'ocupacion', 'estado_civil',
        'nacionalidad', 'nivel_educativo', 'estado_auditoria'
    ];
    
    protected $hidden = ['contrasena'];

    protected $attributes = [
        'estado_auditoria' => '1'
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }
    
    public function sanciones()
    {
        return $this->hasMany(Sancion::class, 'usuario_id');
    }

    public function scopeActivos($query)
    {
        return $query->where('estado_auditoria', '1');
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
