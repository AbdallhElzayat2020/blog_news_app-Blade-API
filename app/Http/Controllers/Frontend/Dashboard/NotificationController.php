<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notifications', compact('user'));
    }
}
