<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\SearchInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public $serach;

    public function __construct(SearchInterface $search)
    {
        $this->serach = $search;
    }

    public function __invoke(Request $request)
    {
        return $this->serach->index($request);
    }
}
