<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\Admin\SendOtpNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForgetPasswordController extends Controller
{
    public function forgotPassword(): View
    {
        return view('admin.layouts.auth.password.forget-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email', 'string', 'max:255'],
        ]);
        $admin = Admin::whereEmail($request->email)->first();
        if (!$admin) {
            return redirect()->back()->with(['email' => 'Try again Latter']);
        }

        $admin->notify(new SendOtpNotification());

        return to_route('admin.password.show-otp-form', ['email' => $admin->email])
            ->with('success', 'OTP sent successfully to your email address.');
    }

    public function showOtpForm($email)
    {
        return view('admin.layouts.auth.password.email-send-notification', ['email' => $email]);
    }


    public function verifyOtpForm(Request $request)
    {
        return $request;
    }
}
