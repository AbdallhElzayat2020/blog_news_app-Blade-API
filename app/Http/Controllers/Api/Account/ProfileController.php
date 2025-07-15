<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\SettingRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function App\Http\Helpers\apiResponse;

class ProfileController extends Controller
{

    public function updateSettings(SettingRequest $request)
    {
        $request->validated();

        $user = auth()->user();

        if (!$user) {
            return apiResponse(404, 'User not found');
        }

        $user->update($request->except('avatar'));

        ImageManager::uploadImage($request, null, $user);

        return apiResponse(200, 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {

        $request->validate($this->filterPasswordRequest());

        $user = auth()->user();

        if (!$user) {
            return apiResponse(404, 'User not found');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return apiResponse(400, 'Current password does not match');
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return apiResponse(200, 'Password changed successfully');
    }


    /**
     * Validation rules for password change request.
     *
     * @return array
     */
    private function filterPasswordRequest(): array
    {
        return [
            'current_password' => ['required', 'string', 'min:8', 'current_password'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
            'password_confirmation' => ['required', 'string'],
        ];
    }
}
