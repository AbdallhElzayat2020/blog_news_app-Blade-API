<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\PostRequest;
use App\Interfaces\UserPostProfileInterface;


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

    public function edit($slug)
    {
        
    }

    public function delete($id)
    {
        
    }

}
