<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetPasswordForm($email)
    {
        return view('admin.layouts.auth.password.reset-password', ['email' => $email]);
    }

    public function ResetPassword(Request $request)
    {
        $this->validatePassword($request);

        $admin = Admin::whereEmail($request->email)->first();
        if (!$admin) {
            return redirect()->back()->with(['error' => 'Try again Latter!']);
        }
        $admin->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.show-login-form')->with('success', 'Password reset successfully');
    }

    public function validatePassword($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ]);
    }
}
