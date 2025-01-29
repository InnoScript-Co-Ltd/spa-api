<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(function () {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::middleware('dashboard')
            ->group(base_path('routes/dashboard.php'));

        Route::middleware('commands')
            ->group(base_path('routes/console.php'));

        Route::get('/up', function () {
            return response()->json(['status' => 'up']);
        });
    })
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
