<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function getPosts()
    {
        $posts = Post::active()->get();
        return response()->json($posts);
    }
}
