<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function App\Http\Helpers\apiResponse;

class ResetPasswordController extends Controller
{
    public $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required', 'min:8', 'max:8',],
            'email' => ['required', 'exists:users,email', 'max:80'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            apiResponse(404, 'User not found');
        }

        $otp = $this->otp->validate($request->email, $request->token);

        if (!$otp->status) {
            return apiResponse(400, 'Invalid OTP');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return apiResponse(200, 'Password reset successfully.');
    }
}
