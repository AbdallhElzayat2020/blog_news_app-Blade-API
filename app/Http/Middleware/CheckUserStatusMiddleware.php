<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function App\Http\Helpers\apiResponse;

class CheckUserStatusMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('web')->check() && auth()->guard('web')->user()->status === 'inactive') {
            // If the user is inactive, redirect them to a specific route or show an error message
            return redirect()->route('frontend.waiting');
        }
        return $next($request);
    }
}
