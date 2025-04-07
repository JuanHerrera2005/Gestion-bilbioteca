<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::activos()
                    ->withCount(['prestamos', 'sanciones'])
                    ->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function loginForm()
    {
        return view('usuarios.login');
    }

    public function login(Request $request)
    {
        // Validación básica
        $request->validate([
            'email' => 'required|email',
            'contrasena' => 'required',
        ]);

        // Buscar usuario por email
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificar si existe y la contraseña es correcta
        if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
            // Iniciar sesión manualmente
            Auth::login($usuario);

            // Redirigir al inicio u otra ruta protegida
            return redirect()->intended('/');
        } else {
            // Volver al login con mensaje de error
            return back()->withErrors([
                'email' => 'Correo o contraseña incorrectos',
            ])->withInput($request->only('email'));
        }
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        if (!empty($validated['contrasena'])) {
            $validated['contrasena'] = bcrypt($validated['contrasena']);
        }

        Usuario::create($validated);

        return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario registrado exitosamente');
    }

    public function show(Usuario $usuario)
    {
        $usuario->load(['prestamos.ejemplar.libro', 'sanciones']);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $validated = $this->validateRequest($request, $usuario);

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

    public function destroy(Usuario $usuario)
    {
        $usuario->update(['estado_auditoria' => '0']);

        return redirect()
                ->route('usuarios.index')
                ->with('success', 'Usuario desactivado exitosamente');
    }

    public function restore($id)
    {
        $usuario = Usuario::withTrashed()->findOrFail($id);
        $usuario->update(['estado_auditoria' => '1']);

        return back()
                ->with('success', 'Usuario reactivado exitosamente');
    }

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
