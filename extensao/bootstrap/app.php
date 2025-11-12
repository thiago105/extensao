<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Importe as classes necessárias
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.ambos' => \App\Http\Middleware\AuthAmbos::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        
        // 👇 A MUDANÇA ESTÁ AQUI 👇
        // Trocamos 'unauthenticated' por 'render' e passamos o tipo da exceção
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            
            // Pega o guard que falhou (ex: 'web', 'instituicao')
            $guard = data_get($e->guards(), 0);

            // ⚠️ CONFIRME O NOME DO SEU GUARD DE INSTITUIÇÃO AQUI ⚠️
            if ($guard === 'instituicao') { 
                
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Não autenticado.'], 401);
                }
                
                // ⚠️ CONFIRME O NOME DA ROTA DE LOGIN DA INSTITUIÇÃO ⚠️
                return redirect()->guest(route('instituicao.login')); 
            }

            // Para todos os outros casos (como o guard 'web' ou 'usuario')
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Não autenticado.'], 401);
            }
            
            // ⚠️ CONFIRME O NOME DA ROTA DE LOGIN DO USUÁRIO PADRÃO ⚠️
            return redirect()->guest(route('login')); 
        });
        // 👆 FIM DO BLOCO DE CÓDIGO 👆

    })->create();