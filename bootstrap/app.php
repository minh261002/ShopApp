<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/admin.php',
            __DIR__ . '/../routes/web.php'
        ],
        api: __DIR__ . '/../routes/api/v1.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\CustomAuthMiddleware::class,
            'admin' => \App\Http\Middleware\AdminLoginMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'login' => \App\Http\Middleware\LoginMiddleware::class,
            'client' => \App\Http\Middleware\ClientAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();