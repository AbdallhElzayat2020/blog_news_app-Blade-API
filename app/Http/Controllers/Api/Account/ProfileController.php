<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\SettingRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

}
