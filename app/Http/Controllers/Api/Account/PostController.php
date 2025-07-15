<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Auth;
use function App\Http\Helpers\apiResponse;

class PostController extends Controller
{
    public function getPosts()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $posts = $user->posts()->active()->with('category')->get();

        if ($posts->count() < 0 || $posts->isEmpty()) {
            return apiResponse(404, 'No Posts Found for this User');
        }
        return apiResponse(200, 'User Posts', ['user_posts' => PostCollection::make($posts)]);
    }
}
