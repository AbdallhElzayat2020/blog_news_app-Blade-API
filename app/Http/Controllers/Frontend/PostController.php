<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index($slug)
    {


        $post = Post::with(['category', 'images', 'comments' => function ($query) {
            $query->limit(3);
        }])->whereSlug($slug)->firstOrFail();
        if (!$post) {
            abort(404, 'Post not found');
        }

        $category = $post->category;
        $related_posts = $category->posts()
            ->select('id', 'title', 'slug', 'description')
            ->where('id', '!=', $post->id)
            ->with('images')
            ->latest()
            ->take(4)
            ->get();


        $post->increment('number_of_views');


        return view('frontend.show-single-post', compact('post', 'related_posts'));
    }
}
