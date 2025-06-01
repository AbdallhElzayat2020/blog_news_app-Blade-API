<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'unique:' . User::class, 'string', 'max:50'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone'],
                'country' => ['nullable', 'string', 'max:50'],
                'city' => ['nullable', 'string', 'max:50'],
                'street' => ['nullable', 'string', 'max:50'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'avatar' => ['nullable', 'image', 'max:3000', 'mimes:jpg,jpeg,png'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'street' => $request->street,
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $file_name = Str::slug($user->username) . '_' . time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('uploads/users', $file_name, 'uploads');

                $user->update(['avatar' => $path,]);
            }

            event(new Registered($user));

            Auth::login($user);

            Session::flash('success', 'Registration successful!');

            return redirect(route('frontend.dashboard.profile', absolute: false));

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
