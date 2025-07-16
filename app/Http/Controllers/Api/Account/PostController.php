<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\PostRequest;
use App\Http\Requests\Frontend\Dashboard\UpdatePostRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\PostCollection;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotification;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
            return apiResponse(403, 'You are not authorized to delete this post.');
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


    public function getPostComments($id)
    {


        $user = auth()->user();
        $post = $user->posts()->where('id', $id)->first();
        if (!$post) {
            return apiResponse(404, 'Post not found');
        }
        $comments = $post->comments()->latest()->whereStatus('active')->get();
        if ($comments->isEmpty()) {
            return apiResponse(404, 'No comments found for this post');
        }
        return apiResponse(200, 'Post Comments', CommentCollection::make($comments));

    }


    public function updateUserPost(UpdatePostRequest $request, $id)
    {
        $request->validated();
        $user = auth()->user();
        $post = $user->posts()->where('id', $id)->first();

        if (!$post) {
            return apiResponse(404, 'Post not found');
        }

        if ($user->id !== $post->user_id) {
            return apiResponse(403, 'You are not authorized to update this post.');
        }

        try {
            DB::beginTransaction();

            $this->commentAble($request);

            $post->update($request->except('images'));

            ImageManager::deleteImages($post);
            ImageManager::uploadImage($request, $post);

            DB::commit();

            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');

            return apiResponse(200, 'Post updated successfully!');
        } catch (\Exception $e) {
            Log::error('error from updateUserPost: ' . $e->getMessage());
            DB::rollBack();
            return apiResponse(500, $e->getMessage());
        }
    }


    function storeComment(Request $request)
    {
        $request->validate($this->validateComment($request));

        $post = Post::find($request->post_id);

        $comment = $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip(),
        ]);

        if (!$comment->save()) {
            return apiResponse(400, 'Failed to add comment try again later');
        }

        // get post and user for sent notification
//        $user = $post->user;
//        $user->notify(new NewCommentNotification($comment, $post));

//        $comment->load('user');

        return apiResponse(200, 'Comment added successfully!');
    }


    public function validateComment($request)
    {
        return [
            'comment' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'sometimes','exists:users,id'],
        ];
    }


    public function commentAble($request)
    {
        return $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
    }
}
