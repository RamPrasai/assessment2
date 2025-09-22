<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',   // ⬅️ load API routes
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Keep your custom aliases
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);
        // No Sanctum SPA middleware needed for **token** auth mode
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
