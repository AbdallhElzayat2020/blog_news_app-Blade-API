<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Frontend\CheckNotificationReadAt;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
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
