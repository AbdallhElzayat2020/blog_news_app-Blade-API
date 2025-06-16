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

    public function markAllRead(Request $request)
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function delete(Request $request)
    {

        $notification_id = $request->notification_id;
        $notification = auth()->user()->notifications()->where('id', $notification_id)->first();

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }

        $notification->delete();
        return redirect()->back()->with('success', 'deleted successfully.');
    }

    public function deleteAll()
    {
        $user = auth()->user();
        $user->notifications()->delete();
        return redirect()->back()->with('success', 'notifications deleted successfully.');

    }
}
