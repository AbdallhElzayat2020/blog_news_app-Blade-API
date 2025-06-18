<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticatedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('admin')->check()) {
            // If the user is authenticated, redirect to the admin dashboard
            return redirect()->route('admin.dashboard.index');
        }
        return $next($request);
    }
}
