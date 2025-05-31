<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(string $slug)
    {


        $mainPost = Post::with(['category', 'images', 'comments' => function ($query) {
            $query->limit(3);
        }])->whereSlug($slug)->firstOrFail();
        if (!$mainPost) {
            abort(404, 'Post not found');
        }

        $category = $mainPost->category;
        $related_posts = $category->posts()
            ->select('id', 'title', 'slug', 'description')
            ->where('id', '!=', $mainPost->id)
            ->with('images')
            ->latest()
            ->take(4)
            ->get();


        $mainPost->increment('number_of_views');


        return view('frontend.show-single-post', compact('mainPost', 'related_posts'));
    }

    public function getAllComments(string $slug)
    {
        $post = Post::whereSlug($slug)->first();
        if (!$post) {
            abort(404, 'Post not found');
        }
        $comments = $post->comments()->with('user')->latest()->get();
        return response()->json($comments);
    }
}
