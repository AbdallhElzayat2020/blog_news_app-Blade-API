<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\PostRequest;
use App\Interfaces\UserPostProfileInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public $postProfile;

    public function __construct(UserPostProfileInterface $postProfile)
    {
        $this->postProfile = $postProfile;
    }

    public function index(): View
    {
        return $this->postProfile->index();
    }

    public function store(PostRequest $request)
    {
        return $this->postProfile->store($request);
    }


}
