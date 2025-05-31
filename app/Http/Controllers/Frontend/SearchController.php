<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $keyword = strip_tags($request->search);
        $posts = Post::active()->with('images')->where('title', 'like', '%' . $keyword . '%')
            ->latest()->paginate(9)->withQueryString();

        return view('frontend.search-posts', compact('posts'));
    }
}
