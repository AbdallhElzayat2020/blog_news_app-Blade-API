<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use function App\Http\Helpers\apiResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategories()
    {
        $categories = Category::active()->get();
        if (!$categories) {
            return apiResponse(404, 'No categories found');
        }
        return apiResponse(200, 'Categories', CategoryCollection::make($categories));
    }


    public function getCategoryPosts($slug)
    {
        $category = Category::active()->whereslug($slug)->first();

        if (!$category) {
            return apiResponse(404, 'Category not found');
        }
        $posts = $category->posts()->active()->get();

        if (!$posts) {
            return apiResponse(404, 'No posts found for this category');
        }

        return apiResponse(200, 'Posts', PostCollection::make($posts));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
