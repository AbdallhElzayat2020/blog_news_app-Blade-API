<?php

namespace App\Repositories;

use App\Interfaces\UserPostProfileInterface;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class UserPostProfileRepository implements UserPostProfileInterface
{
    public function index(): View
    {
        $user = auth()->user();

        $posts = $user->posts()->with(['images', 'category', 'user', 'comments'])->active()->latest()->get();

        return view('frontend.dashboard.profile', compact('user', 'posts'));
    }

    public function store($request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        try {
            DB::beginTransaction();

            $this->commentAble($request);

            $post = auth()->user()->posts()->create($request->except('images'));
            // Handle image upload
            ImageManager::uploadImage($request, $post);

            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', $e->getMessage());
        }

        return redirect()->back()->with('success', 'created successfully!');

    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            abort(403, 'You are not authorized to delete this post.');
        }

        try {
            DB::beginTransaction();

            // Delete images
            ImageManager::deleteImages($post);

            $post->delete();

            // Clear relevant cache
            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');

            DB::commit();

            return redirect()->back()->with('success', 'Post deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Optionally: log the error
            // Log::error('Post deletion failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function getComments($id): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->with('user')->latest()->get();

        if (!$comments) {
            return response()->json([
                'data' => null,
                'message' => 'No comments found for this post.'
            ], 404);
        }
        return response()->json(
            [
                'data' => $comments,
                'message' => 'Comments retrieved successfully.'
            ],
        );

    }

    public function commentAble($request)
    {
        return $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
    }
}