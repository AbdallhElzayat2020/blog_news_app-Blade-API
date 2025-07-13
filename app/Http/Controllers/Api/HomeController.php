<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use function App\Http\Helpers\apiResponse;

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
            ->with(['user:name,status,id', 'category:name,id,status', 'admin:name,status,id', 'images:path,id,post_id'])
            ->activeUser()
            ->activeCategory()
            ->active();

        $all_posts = clone $query->latest()->paginate(9);

        $latest_posts = $this->latestPosts(clone $query);
        $most_read_posts = $this->mostReadPosts(clone $query);
        $oldest_posts = $this->oldestPosts(clone $query);
        $popular_posts = $this->popularPosts(clone $query);
        $category_with_posts = $this->categoryWithPosts();

        $data = [
            'all_posts' => (PostCollection::make($all_posts))->response()->getData(true),
            'latest_posts' => PostCollection::make($latest_posts),
            'category_with_posts' => CategoryCollection::make($category_with_posts),
            'most_read_posts' => PostCollection::make($most_read_posts),
            'oldest_posts' => PostCollection::make($oldest_posts),
            'popular_posts' => PostCollection::make($popular_posts),
        ];

        return apiResponse(200, 'success', $data);
    }

    public function showPost($slug)
    {
        $post = Post::with(['user', 'category', 'admin', 'images'])
            ->whereSlug($slug)
            ->active()
            ->activeUser()
            ->activeCategory()
            ->first();

        if (!$post) {
            return apiResponse(404, 'Post not found', null);
        }

        $post->increment('number_of_views');

        return apiResponse(200, null, PostResource::make($post));
    }


    /**
     * ===========================================================
     * Helper methods to retrieve various types of posts
     * ===========================================================
     */

    /**
     * Get the latest posts
     */
    public function latestPosts(Builder $query)
    {
        $popular_posts = $query->latest()->take(4)->get();

        if (!$popular_posts) {
            apiResponse(404, 'No posts found', null);
        }
        return $popular_posts;

    }

    /**
     * Get the most read posts
     */
    public function mostReadPosts(Builder $query)
    {
        $most_read_posts = $query->orderByDesc('number_of_views', 'desc')->take(4)->get();
        if (!$most_read_posts) {
            apiResponse(404, 'No posts found', null);
        }
        return $most_read_posts;
    }

    /**
     * Get the oldest posts
     */
    public function oldestPosts(Builder $query)
    {
        $oldest_posts = $query->oldest()->take(3)->get();
        if (!$oldest_posts) {
            apiResponse(404, 'No posts found', null);
        }
        return $oldest_posts;

    }

    /**
     * Get the popular posts based on comment count
     */
    public function popularPosts(Builder $query)
    {
        $popular_posts = $query->withCount(['comments'])
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->get();

        if (!$popular_posts) {
            apiResponse(404, 'No posts found', null);
        }

        return $popular_posts;
    }

    /**
     *
     * Get categories with their latest posts
     */
    public function categoryWithPosts()
    {

        $categories = Category::active()->get();
        if ($categories->isEmpty()) {
            apiResponse(404, 'No categories found', null);
        }
        return $categories->map(function (Category $category) {
            $category->posts = $category->posts()->active()->latest()->take(4)->get();
            return $category;
        });
    }
}