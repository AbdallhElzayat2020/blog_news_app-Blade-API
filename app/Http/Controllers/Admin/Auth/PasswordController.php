<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('admin.layouts.auth.password.forget-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email', 'string', 'max:255'],
        ]);

        return $request;
    }
}
