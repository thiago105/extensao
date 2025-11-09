<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstituicaoLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $inst = \App\Models\Instituicao::where('email', $credentials['email'])->first();
        if (!$inst) {
            return back()->withErrors(['login_error' => 'E-mail ou senha incorretos.'])->withInput();
        }

        if (Auth::guard('instituicao')->attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'login_error' => 'Senha ou e-mail incorretos.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::guard('instituicao')->check()) {
            Auth::guard('instituicao')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
