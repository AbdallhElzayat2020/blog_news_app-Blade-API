<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['images'])->latest()->paginate(9);
        $greatest_post_views = Post::orderBy('number_of_views', 'desc')->limit(3)->get();

        return view('frontend.home', compact('posts', 'greatest_post_views'));
    }
}
