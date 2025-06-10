<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\SettingRequest;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingController extends Controller
{
    //
    public function index(): View
    {
        $user = auth()->user();
        return view('frontend.dashboard.setting', compact('user'));
    }

    public function update(SettingRequest $request)
    {
        $request->validated();
        $user = User::findOrFail(auth()->user()->id);

        $user->update($request->except('avatar'));

        ImageManager::uploadImage($request, null, $user);

        return redirect()->back()->with('success', 'updated successfully!');

    }

    public function changePassword(Request $request)
    {
//        $request->validate($this->filterPasswordRequest());

        $request->validate([
            'current_password' => ['required', 'string', 'min:8', 'current_password'],
            'password' => ['required',],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with(['error' => 'password does not match!']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }

    public function filterPasswordRequest()
    {
        return [
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required',],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }
}
