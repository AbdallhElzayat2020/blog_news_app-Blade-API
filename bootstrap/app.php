<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Frontend\CheckNotificationReadAt;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

        // Admin Routes
        then: function () {
            Route::prefix('admin/')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check_notification_read_at' => CheckNotificationReadAt::class,
        ]);

        // make middleware global for all routes
        $middleware->web([
            CheckNotificationReadAt::class
        ]);
        $middleware->api([
            CheckNotificationReadAt::class
        ]);

        //        $middleware->append(CheckNotificationReadAt::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
