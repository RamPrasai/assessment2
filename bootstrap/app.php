<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Your alias
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        // ✅ Trust Render's reverse proxy so Laravel knows the request is HTTPS
        $middleware->trustProxies(at: '*');
        // (optional) You can also restrict hosts:
        // $middleware->trustHosts(['assessment2nd.onrender.com']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
