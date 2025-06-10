<?php

namespace App\Interfaces;

interface UserPostProfileInterface
{
    public function index();

    public function store($request);

    public function destroy($id);

    public function getComments($id);

    public function editPost($slug);

    public function updatePost($slug, $request);
}