<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function App\Http\Helpers\apiResponse;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email', 'max:100'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('login_user', [], now()->addMinutes(1))->plainTextToken;

            return apiResponse(200, 'Login successfully', ['token' => $token]);
        }

        return apiResponse(400, 'Login failed', ['error' => 'Invalid credentials']);

    }

    public function logout(Request $request)
    {
        return $request;
    }
}
