<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAmbos
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('web')->check() && !Auth::guard('instituicao')->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
