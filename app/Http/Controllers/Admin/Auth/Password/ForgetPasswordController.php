<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\Admin\SendOtpNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForgetPasswordController extends Controller
{
    public $otp2;

    public function __construct()
    {
        $this->otp2 = new  Otp();
    }

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
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'otp' => ['required', 'min:8', 'max:8', 'string']
        ]);
        $otp = $this->otp2->validate($request->email, $request->otp);
        if (!$otp->status) {
            return redirect()->back()->with(['error' => 'Invalid OTP, please try again.']);
        }
        return to_route('admin.password.show-reset-password-form', ['email' => $request->email])
            ->with('success', 'OTP verified successfully. You can now reset your password.');
    }
}
