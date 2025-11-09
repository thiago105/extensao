<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $userModel = \App\Models\Usuario::where('email', $credentials['email'])->first();
        if (!$userModel) {
            return back()->withErrors(['login_error' => 'E-mail ou senha incorretos.'])->withInput();
        }

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'login_error' => 'Senha ou e-mail incorretos.',
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
