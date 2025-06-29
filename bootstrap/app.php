<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Http\Middleware\HandleCors;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(append: [
            ForceJsonResponse::class,
            HandleCors::class,
        ]);
        
        // Optionnel : exclure CSRF pour le frontend en dev
        $middleware->validateCsrfTokens(except: [
            'http://127.0.0.1:3000/',
            'http://localhost:8080/',
            "http://localhost:3000/"
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
