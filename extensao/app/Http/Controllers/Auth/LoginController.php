<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        $tipo = $request->query('tipo', 'usuario'); // padrão = usuario
        return view('auth.login', compact('tipo'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $tipo = $request->input('tipo', 'usuario');

        if ($tipo === 'usuario') {
            if (Auth::guard('web')->attempt($credentials)) {
                return redirect()->intended('/area-do-usuario');
            }
        }

        if ($tipo === 'instituicao') {
            if (Auth::guard('instituicao')->attempt($credentials)) {
                return redirect()->intended('/area-da-instituicao');
            }
        }

        return back()->withErrors([
            'login_error' => 'E-mail ou senha incorretos.'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('instituicao')->check()) {
            Auth::guard('instituicao')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
