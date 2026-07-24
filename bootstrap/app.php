<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
        
        $middleware->alias([
            'permission' => \App\Http\Middleware\PermissionMiddleware::class,
            'subscription' => \App\Http\Middleware\CheckSubscription::class,
            'plan.limit' => \App\Http\Middleware\PlanValidationMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->render(function (Throwable $e) {
        //     return response()->json([
        //         'error' => 'Server Error',
        //         'message' => $e->getMessage(),
        //         'trace' => $e->getTraceAsString() // Best kept for local development only
        //     ], 500);
        // });
    })->create();




