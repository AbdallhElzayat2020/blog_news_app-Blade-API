<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Notifications\SendOtpVerifyUserEmail;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use function App\Http\Helpers\apiResponse;


class RegisterController extends Controller
{

    public function register(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $user = $this->createUser($request);

            if (!$user->save()) {
                apiResponse(200, 'User registration failed');
            }

            if ($request->hasFile('avatar')) {
                ImageManager::uploadImage($request, null, $user);
            }

            $token = $user->createToken('register_token')->plainTextToken;


            $user->notify(new SendOtpVerifyUserEmail());

            DB::commit();
            return apiResponse(201, 'User created Successfully', ['token' => $token]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error from registration from' . $exception->getMessage());
            return apiResponse(500, $exception->getMessage());
        }
    }

    protected function createUser($request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
        ]);
    }


}
