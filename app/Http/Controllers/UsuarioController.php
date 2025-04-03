<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Prestamo;
use App\Models\Sancion;

class UsuarioController extends Controller
{
   
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }
    
    public function create()
    {
        return view('usuarios.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'tipo_documento' => 'required|in:DNI,Pasaporte,Carnet de Extranjería',
            'numero_documento' => 'required|string|max:20|unique:usuarios',
            'email' => 'required|email|max:255|unique:usuarios',
            'contrasena' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:Masculino,Femenino,Otro',
            'ocupacion' => 'nullable|string|max:100',
            'estado_civil' => 'nullable|string|max:50',
            'nacionalidad' => 'nullable|string|max:100',
            'nivel_educativo' => 'nullable|string|max:100'
        ]);
        
        $validated['contrasena'] = bcrypt($validated['contrasena']);
        
        Usuario::create($validated);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado exitosamente');
    }
    
    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }
    
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }
    
    public function update(Request $request, Usuario $usuario)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'tipo_documento' => 'required|in:DNI,Pasaporte,Carnet de Extranjería',
            'numero_documento' => 'required|string|max:20|unique:usuarios,numero_documento,'.$usuario->usuario_id.',usuario_id',
            'email' => 'required|email|max:255|unique:usuarios,email,'.$usuario->usuario_id.',usuario_id',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:Masculino,Femenino,Otro',
            'ocupacion' => 'nullable|string|max:100',
            'estado_civil' => 'nullable|string|max:50',
            'nacionalidad' => 'nullable|string|max:100',
            'nivel_educativo' => 'nullable|string|max:100'
        ]);
        
        $usuario->update($validated);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }
    
    public function historial(Usuario $usuario)
    {
        $prestamos = Prestamo::with('ejemplar.libro')
            ->where('usuario_id', $usuario->usuario_id)
            ->orderBy('fecha_prestamo', 'desc')
            ->get();
        
        $sanciones = Sancion::where('usuario_id', $usuario->usuario_id)
            ->orderBy('fecha_inicio', 'desc')
            ->get();
            
        return view('usuarios.historial', compact('usuario', 'prestamos', 'sanciones'));
    }
    
    // Agregar método destroy si necesitas eliminar usuarios
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
