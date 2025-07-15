<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendOtpResetPasswordNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use function App\Http\Helpers\apiResponse;

class ForgetPasswordController extends Controller
{
    public $otp2;

    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email', 'max:80'],
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            apiResponse(404, 'User not found');
        }
        $user->notify(new  SendOtpResetPasswordNotification());

        return apiResponse(200, 'OTP sent successfully to your email address check it.');
    }
}
