<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RolAdmin;
use App\Http\Middleware\RolGestor;
use App\Http\Middleware\RolUsuario;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'rol.admin' => RolAdmin::class,
            'rol.gestor' => RolGestor::class,
            'rol.usuario' => RolUsuario::class,
        ]);

        $middleware->redirectGuestsTo('/api/nologin');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
