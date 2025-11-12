<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {

            // Se for uma rota da área da instituição (ex: /instituicao ou /area-da-instituicao)
            if ($request->is('area-da-instituicao*') || $request->is('instituicao*')) {
                return route('login.instituicao');
            }

            // Caso contrário, redireciona para o login do usuário
            return route('login.usuario');
        }

        return null;
    }
}
