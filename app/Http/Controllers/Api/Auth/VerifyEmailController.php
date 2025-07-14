<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\SendOtpVerifyUserEmail;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use function App\Http\Helpers\apiResponse;

class VerifyEmailController extends Controller
{

    public $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'token' => ['required', 'min:8', 'max:8'],
        ]);
        $user = $request->user();

        $otp2 = $this->otp->validate($user->email, $request->token);

        if (!$otp2->status) {
            return apiResponse(400, 'Invalid OTP');
        }

        $user->update(['email_verified_at' => now()]);

        return apiResponse(200, 'Email verified successfully.', ['email' => $user->email]);
    }

    public function resendOtp()
    {
        $user = request()->user();
        $user->notify(new SendOtpVerifyUserEmail());
        return apiResponse(200, 'OTP send again successfully.');
    }
}
