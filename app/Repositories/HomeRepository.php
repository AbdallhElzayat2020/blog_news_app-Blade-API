<?php

namespace App\Repositories;

use App\Interfaces\HomeInterface;
use App\Models\Category;
use App\Models\Post;

class HomeRepository implements HomeInterface
{
    public function index()
    {
        $posts = Post::active()->with('images')
            ->latest()
            ->paginate(9);

        $greatest_post_views = Post::active()->with('images')
            ->orderBy('number_of_views', 'desc')
            ->limit(3)
            ->get();

        $oldest_posts = Post::active()->with('images')
            ->oldest()
            ->limit(3)
            ->get();


        $popular_posts = Post::active()->with('images')
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();


//        $category_with_posts = Category::has('posts', '>=', 2)
//            ->active()->select('name', 'id', 'slug')->with(['posts' => function ($query) {
//                $query->with('images')
//                    ->limit(4);
//            }])->get();

        $categories = Category::active()->select('id', 'name', 'slug')->latest()->get();
        $category_with_posts = $categories->map(function (Category $category) {
            $category->posts = $category->posts()->active()->with('images')->limit(3)->get();
            return $category;
        });

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