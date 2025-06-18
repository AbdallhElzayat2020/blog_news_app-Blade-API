<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // check if the user is authenticated
        if (!auth()->guard('admin')->check()) {
            // redirect to the login page
            return redirect()->route('admin.show-login-form');
        }
        return $next($request);
    }
}
