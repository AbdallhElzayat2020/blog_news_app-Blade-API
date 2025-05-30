<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();

        $posts = $category->posts()->with('images')->paginate(9);


        return view('frontend.category-posts', compact('category', 'posts'));
    }
}
