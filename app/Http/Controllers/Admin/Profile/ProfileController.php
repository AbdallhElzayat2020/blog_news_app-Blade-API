<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate($this->validateData());

        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        if (!Hash::check($request->password, $admin->password)) {
            return redirect()->back()->withErrors(['password' => 'The provided password does not match your current password.']);
        }
        $admin->update($request->except(['password']));
        Session::flash('success', 'Profile updated successfully');
        return redirect()->back();
    }

    private function validateData()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'email' => ['required', 'email', 'max:200', 'unique:admins,email,' . auth()->guard('admin')->user()->id],
            'password' => ['required', 'string']
        ];
    }
}
