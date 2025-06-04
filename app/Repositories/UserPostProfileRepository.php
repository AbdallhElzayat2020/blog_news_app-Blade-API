<?php

namespace App\Repositories;

use App\Interfaces\UserPostProfileInterface;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserPostProfileRepository implements UserPostProfileInterface
{
    public function index():View
    {
        $user = auth()->guard('web')->user();
        return view('frontend.dashboard.profile', compact('user'));
    }

    public function store($request): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::beginTransaction();
            $request->validated();

            $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);

            $request->merge(['user_id' => auth()->guard('web')->id()]);

            $post = Post::create($request->except('images'));

            // Handle image upload
            ImageManager::uploadImage($request, $post);

            Cache::forget('read_more_posts');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'created successfully!');

    }
}