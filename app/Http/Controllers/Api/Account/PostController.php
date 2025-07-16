<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\PostRequest;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use function App\Http\Helpers\apiResponse;

class PostController extends Controller
{
    public function getUserPosts()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $posts = $user->posts()->active()->activeCategory()->get();

        if ($posts->count() < 0 || $posts->isEmpty()) {
            return apiResponse(404, 'No Posts Found for this User');
        }
        return apiResponse(200, 'User Posts', PostCollection::make($posts));
    }

    public function createUserPost(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $this->commentAble($request);

            $post = auth()->user()->posts()->create($request->except('images'));

            ImageManager::uploadImage($request, $post);

            DB::commit();

            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');

            return apiResponse(201, 'Post created successfully!');
        } catch (\Exception $e) {
            Log::error('error from createUserPost: ' . $e->getMessage());
            DB::rollBack();
            return apiResponse(500, $e->getMessage());
        }
    }

    public function deleteUserPost($id)
    {
        $post = Post::find($id);
        $user = Auth::user();
        if ($user->id !== $post->user_id) {
            abort(403, 'You are not authorized to delete this post.');
        }

        if (!$post) {
            return apiResponse(404, 'Post not found');
        }

        try {
            DB::beginTransaction();

            ImageManager::deleteImages($post);

            $post->delete();

            // Clear relevant cache
            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');

            DB::commit();

            return apiResponse(200, 'Post deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            // Optionally: log the error
            Log::error('Post deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function commentAble($request)
    {
        return $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
    }
}
