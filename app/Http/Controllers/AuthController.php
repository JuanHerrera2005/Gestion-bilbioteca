<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Verificar credenciales
        $credentials = $request->only('email', 'password');
        $credentials['contrasena'] = $credentials['password']; // Mapear password a contrasena
        unset($credentials['password']);

        // Verificar estado del usuario
        $user = Usuario::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ])->withInput($request->only('email'));
        }

        if ($user->estado_auditoria != '1') {
            return back()->withErrors([
                'email' => 'Tu cuenta está inactiva. Por favor, contacta al administrador.',
            ])->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
