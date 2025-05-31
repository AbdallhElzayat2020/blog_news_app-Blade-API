<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\HomeInterface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public $home;

    public function __construct(HomeInterface $home)
    {
        $this->home = $home;
    }

    public function index()
    {
        return $this->home->index();


    }
}
