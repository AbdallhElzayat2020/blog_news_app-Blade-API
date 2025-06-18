<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function handleLogin(Request $request)
    {
        $data = $this->filterData($request);
        $credentials = $request->only('email', 'password');
        // Attempt to log the user in
        if (!Auth::guard('admin')->attempt($credentials, $data['remember'])) {
            return redirect()->back()->withErrors([
                'error' => 'The provided credentials do not match our records.',
            ]);
        }
        return redirect()->intended(route('admin.dashboard.index'))->with('success', 'Welcome back');

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.show-login-form')->with('success', 'You have been logged out successfully.');
    }


    /*
     *============================
        * Filter Data for Validation
     *============================
     */
    private function filterData($request): array
    {
        return $request->validate([
            'email' => ['required', 'email', 'max:255', 'exists:admins,email'],
            'password' => ['required', 'string', 'min:8'],
            'remember' => ['in:on,off', 'nullable'],
        ]);
    }
}
