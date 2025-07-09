<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get posts for the API
     * 
     * Retrieves various types of posts including:
     * - All active posts
     * - Latest posts (4)
     * - Categories with their latest posts (4 per category)
     * - Most read posts (3)
     * - Oldest posts (3)
     * - Popular posts based on comment count (3)
     * 
     * @return \Illuminate\Http\JsonResponse Returns popular posts as JSON
     */
    public function getPosts()
    {
        $query = Post::query();

        $posts = $query->active()->latest()->get();

        $latest_posts = $query->latest()->take(4)->get();

        $categories = Category::all();
        $category_with_posts = $categories->map(function (Category $category) {
            $category->posts = $category->posts()->active()->latest()->take(4)->get();
            return $category;
        });

        $most_read_posts = $query->orderBy('number_of_views', 'desc')->take(3)->get();

        $oldest_posts = $query->oldest()->take(3)->get();

        $popular_posts = $query->withCount(['comments'])
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        return response()->json($popular_posts);
    }
}
