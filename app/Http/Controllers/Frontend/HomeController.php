<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')
            ->latest()
            ->paginate(9);

        $greatest_post_views = Post::with('images')
            ->orderBy('number_of_views', 'desc')
            ->limit(3)
            ->get();

        $oldest_posts = Post::with('images')
            ->oldest()
            ->limit(3)
            ->get();


        $popular_posts = Post::with('images')
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();


        $category_with_posts = Category::with(['posts' => function($query) {
            $query->with('images')
                ->limit(4);
        }])->get();



//        $categories = Category::select('name', 'id', 'slug')->get();
//
//        $category_with_posts = $categories->map(function (Category $category) {
//            $category->posts = $category->posts()->with(['images'])->limit(4)->get();
//            return $category;
//        });

        return view('frontend.home', compact(
            'posts',
            'greatest_post_views',
            'oldest_posts',
            'popular_posts',
            'category_with_posts'));
    }
}
