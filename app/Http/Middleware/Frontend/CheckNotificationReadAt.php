<?php

namespace App\Http\Middleware\Frontend;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNotificationReadAt
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notify_id = $request->query('notify');

        if ($notify_id) {
            $notification = auth()->user()->unreadNotifications()->where('id', $notify_id)->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return $next($request);
    }
}
