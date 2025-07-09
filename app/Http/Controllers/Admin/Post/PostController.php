<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\PostRequest;
use App\Http\Requests\Frontend\Dashboard\UpdatePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'user'])->when($request->keyword, function (Builder $query) {
            $query->where('title', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
//        return $request;
        $request->validated();
        try {
            DB::beginTransaction();

            $this->commentAble($request);

            $post = auth()->guard('admin')->user()->posts()->create($request->except('images'));
            // Handle image upload
            ImageManager::uploadImage($request, $post);

            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();

        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $post->update($request->except(['images']));

            if ($request->hasFile('images')) {
                ImageManager::deleteImages($post);
                ImageManager::uploadImage($request, $post);
            }
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('errors', $e->getMessage());
        }

        return to_route('admin.posts.index')->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $post = Post::findOrFail($id);
            if ($post->images->count() > 0) {
                ImageManager::deleteImages($post);
            }
            $post->delete();
            Cache::forget('read_more_posts');
            Cache::forget('popular_posts');
            Cache::forget('latest_posts');
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete Post, please try again later.');
        }

        return redirect()->back()->with('success', 'deleted successfully');
    }

    public function changeStatus(string $id)
    {

        $post = Post::findOrFail($id);
        if ($post->status == 'active') {
            $post->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'blocked successfully');
        } else {
            $post->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Activated successfully');
        }

    }

    public function deletePostImage(Request $request)
    {
        $image = Image::find($request->key);
        if (!$image) {
            return response()->json([
                'message' => 'Image not found'
            ], 404);
        }

        ImageManager::deleteImageLocal($image->path);
        $image->delete();
        return response()->json([
            'message' => 'Image deleted successfully'
        ], 200);
    }

    /*
     * Private methods can be added here for internal logic
     * */
    public function commentAble($request)
    {
        return $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
    }

    public function deleteComment(string $id)
    {
        $comment = Comment::findOrFail($id);
        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
