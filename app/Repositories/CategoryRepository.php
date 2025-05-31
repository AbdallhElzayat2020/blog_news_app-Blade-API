<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\View\View;

class CategoryRepository implements CategoryInterface
{
    public function index($slug):View
    {
        $category = Category::active()->whereSlug($slug)->firstOrFail();
        $posts = $category->posts()->with('images')->paginate(9);

        return view('frontend.category-posts', compact('category', 'posts'));
    }
}