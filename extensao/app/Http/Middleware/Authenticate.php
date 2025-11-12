<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
    if (! $request->expectsJson()) {
        if ($request->is('area-da-instituicao/*')) {
            return route('login.instituicao'); // tua rota de login de instituição
        }
        return route('login.usuario'); // tua rota de login de usuário
    }
}
}
