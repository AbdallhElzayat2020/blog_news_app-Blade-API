<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function App\Http\Helpers\apiResponse;

class CheckUserEmailVerifyApi
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->email_verified_at === null) {
            return apiResponse(400, 'Email not verified', [
                'message' => 'Please verify your email first.',
            ]);
        }

        return $next($request);
    }
}
