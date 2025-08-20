<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authenticate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.check' => \App\Http\Middleware\AuthenticateUser::class,
        ]);

        // Define a middleware group
        $middleware->group('authGroup', [
            'auth.check',   // our custom middleware
            // You can add more here like 'verified', 'throttle:60,1', etc.
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();