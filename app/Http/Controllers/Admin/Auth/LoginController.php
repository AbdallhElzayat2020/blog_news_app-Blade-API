<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.layouts.auth.login');
    }


    public function handleLogin(Request $request)
    {
        $request->validate($this->filterData());

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) {

            session()->flash('success', 'Welcome back, ' . Auth::guard('admin')->user()->name);
            return redirect()->intended(route('admin.dashboard.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    private function filterData(): array
    {
        return [
            'email' => ['required', 'email', 'exists:admins,email'],
            'password' => ['required', 'string', 'min:8'],
            'remember' => ['in:on,off'],
        ];
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.show-login-form')->with('success', 'You have been logged out successfully.');
    }
}
