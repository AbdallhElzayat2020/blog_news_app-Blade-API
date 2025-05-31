<?php

namespace App\Repositories;

use App\Interfaces\SearchInterface;
use App\Models\Post;

class SearchRepository implements SearchInterface
{
    public function index($request)
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