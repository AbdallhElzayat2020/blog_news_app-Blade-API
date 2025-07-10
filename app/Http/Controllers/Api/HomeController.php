<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
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
     */
    public function getPosts()
    {
        $query = Post::query()
            ->with(['user', 'category', 'admin'])
            ->activeUser()
            ->activeCategory()
            ->active();

        $all_posts = clone $query->latest()->paginate(9);

        $latest_posts = $this->latestPosts(clone $query);
        $most_read_posts = $this->mostReadPosts(clone $query);
        $oldest_posts = $this->oldestPosts(clone $query);
        $popular_posts = $this->popularPosts(clone $query);
        $category_with_posts = $this->categoryWithPosts();

        return response()->json([
            'all_posts' => (PostCollection::make($all_posts))->response()->getData(),
            //            'latest_posts' => $latest_posts,
            //            'categories' => $categories,
            //            'category_with_posts' => $category_with_posts,
            //            'most_read_posts' => $most_read_posts,
            //            'oldest_posts' => $oldest_posts,
            //            'popular_posts' => $popular_posts,
        ]);
    }

    public function latestPosts(Builder $query)
    {
        return $query->latest()->take(4)->get();
    }

    public function showPost($slug)
    {

        $post = Post::whereSlug($slug)->active()->activeUser()->activeCategory()->with(['user', 'category'])->first();

        if (!$post) {
            return response()->json([
                'message' => 'Post not found',
                'status' => 404,
            ], 404);
        }
        return response()->json([
            'data' => PostResource::make($post),
        ], 200);
    }


    /**
     * Helper methods to retrieve various types of posts
     */
    public function mostReadPosts(Builder $query)
    {
        return $query->orderByDesc('number_of_views', 'desc')->take(4)->get();
    }

    public function oldestPosts(Builder $query)
    {
        return $query->oldest()->take(3)->get();
    }

    public function popularPosts(Builder $query)
    {
        return $query->withCount(['comments'])
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();
    }

    public function categoryWithPosts()
    {
        $categories = Category::active()->get();
        return $categories->map(function (Category $category) {
            $category->posts = $category->posts()->active()->latest()->take(4)->get();
            return $category;
        });
    }
}