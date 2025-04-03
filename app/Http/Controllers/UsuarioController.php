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
        $usuarios = Usuario::activos()
                    ->withCount(['prestamos', 'sanciones'])
                    ->paginate(10);
                    
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario de creación de usuario
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos
     */
    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        
        // Encriptar contraseña solo si se proporciona
        if (!empty($validated['contrasena'])) {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        }
        
        Usuario::create($validated);

        return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario registrado exitosamente');
    }

    /**
     * Muestra los detalles de un usuario específico
     */
    public function show(Usuario $usuario)
    {
        $usuario->load(['prestamos.ejemplar.libro', 'sanciones']);
        
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Muestra el formulario para editar un usuario
     */
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualiza un usuario en la base de datos
     */
    public function update(Request $request, Usuario $usuario)
    {
        $validated = $this->validateRequest($request, $usuario);
        
        // Solo actualizar contraseña si se proporcionó una nueva
        if (empty($validated['contrasena'])) {
            unset($validated['contrasena']);
        } else {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        }
        
        $usuario->update($validated);

        return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Muestra el historial completo del usuario
     */
    public function historial(Usuario $usuario)
    {
        $prestamos = $usuario->prestamos()
                        ->with('ejemplar.libro')
                        ->orderBy('fecha_prestamo', 'desc')
                        ->paginate(10, ['*'], 'prestamos');
                        
        $sanciones = $usuario->sanciones()
                        ->orderBy('fecha_inicio', 'desc')
                        ->paginate(10, ['*'], 'sanciones');

        return view('usuarios.historial', compact('usuario', 'prestamos', 'sanciones'));
    }

    /**
     * Realiza una eliminación lógica (desactiva el usuario)
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->update(['estado_auditoria' => '0']);
        
        return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario desactivado exitosamente');
    }

    /**
     * Restaura un usuario desactivado
     */
    public function restore($id)
    {
        $usuario = Usuario::withTrashed()->findOrFail($id);
        $usuario->update(['estado_auditoria' => '1']);
        
        return back()
                ->with('success', 'Usuario reactivado exitosamente');
    }

    /**
     * Valida los datos del request para usuarios
     */
    protected function validateRequest(Request $request, Usuario $usuario = null)
    {
        return $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'tipo_documento' => 'required|in:DNI,Pasaporte,Carnet de Extranjería',
            'numero_documento' => [
                'required',
                'string',
                'max:20',
                'unique:usuarios,numero_documento,' . ($usuario?->usuario_id ?? 'NULL') . ',usuario_id'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:usuarios,email,' . ($usuario?->usuario_id ?? 'NULL') . ',usuario_id'
            ],
            'contrasena' => [
                $usuario ? 'nullable' : 'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'genero' => 'nullable|in:Masculino,Femenino,Otro',
            'ocupacion' => 'nullable|string|max:100',
            'estado_civil' => 'nullable|string|max:50',
            'nacionalidad' => 'nullable|string|max:100',
            'nivel_educativo' => 'nullable|string|max:100'
       
        ]);

    }





}
