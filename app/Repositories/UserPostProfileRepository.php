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
        try {
            DB::beginTransaction();
            $request->validated();

            $this->commentAble($request);
            $request->merge(['user_id' => auth()->guard('web')->id()]);

            $post = Post::create($request->except('images'));

            // Handle image upload
            ImageManager::uploadImage($request, $post);

            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');

            DB::commit();
            Cache::forget('read_more_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'created successfully!');

    }

    public function edit($slug): View
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        $user = auth()->user();
        if ($post->user_id != $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $user->posts()->with(['images', 'category', 'user', 'comments'])->active()->latest()->get();
        return view('frontend.dashboard.profile', compact('user', 'posts', 'post'));
    }

    public function update($slug)
    {
        // TODO: Implement update() method.
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

            // Delete the post itself
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