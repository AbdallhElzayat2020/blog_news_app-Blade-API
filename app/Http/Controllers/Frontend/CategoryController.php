<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index($slug)
    {
        return $this->category->index($slug);
    }
}
