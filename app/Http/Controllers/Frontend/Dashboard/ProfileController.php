<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\PostRequest;
use App\Interfaces\UserPostProfileInterface;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public $postProfile;

    public function __construct(UserPostProfileInterface $postProfile)
    {
        $this->postProfile = $postProfile;
    }

    public function index()
    {
        return $this->postProfile->index();
    }

    public function store(PostRequest $request)
    {
        return $this->postProfile->store($request);
    }


    public function destroy($id)
    {
        return $this->postProfile->destroy($id);
    }

    public function getComments($id)
    {
        return $this->postProfile->getComments($id);
    }

    public function editPost($slug)
    {
        return $this->postProfile->editPost($slug);
    }

    public function updatePost($slug, Request $request)
    {
        return $this->postProfile->updatePost($slug, $request);
    }
}
