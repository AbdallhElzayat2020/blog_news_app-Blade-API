<?php

namespace App\Repositories;

use App\Interfaces\UserPostProfileInterface;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserPostProfileRepository implements UserPostProfileInterface
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.dashboard.profile', compact('user'));
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
            $request->merge(['user_id' => auth()->guard('web')->id()]);

            $post = Post::create($request->except('images'));

            // Handle the image upload
            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $filename = Str::slug($request->title) . '_' . Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('uploads/posts', $filename, 'uploads');
                    $post->images()->create([
                        'patssh' => $path,
                        'alt_text' => Str::slug($request->title) . '_' . Str::uuid(),
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'created successfully!');

    }
}