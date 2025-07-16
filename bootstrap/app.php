<?php

use App\Http\Middleware\Admin\AdminAuthMiddleware;
use App\Http\Middleware\Admin\RedirectIfAuthenticated;
use App\Http\Middleware\CheckUserEmailVerifyApi;
use App\Http\Middleware\CheckUserStatusMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Frontend\CheckNotificationReadAt;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/',
    //        then: function () {
    //            Route::middleware('api')
    //                ->prefix('admin')
    //                ->name('admin.')
    //                ->group(base_path('routes/admin.php'));
    //        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check_notification_read_at' => CheckNotificationReadAt::class,
            'auth.admin' => AdminAuthMiddleware::class,
            'guest.admin' => RedirectIfAuthenticated::class,
            'check_user_status' => CheckUserStatusMiddleware::class,
            'verify_email' => CheckUserEmailVerifyApi::class,
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
