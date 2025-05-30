<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index($slug)
    {
        $post = Post::with(['category', 'images'])->whereSlug($slug)->firstOrFail();
        $post->increment('number_of_views');

        $category = $post->category;
        $related_posts = $category->posts()->with('images')->latest()->take(4)->get();


        if (!$post) {
            abort(404, 'Post not found');
        }

        return view('frontend.show-single-post', compact('post', 'related_posts'));
    }
}
