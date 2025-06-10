<?php

namespace App\Interfaces;

interface UserPostProfileInterface
{
    public function index();

    public function store($request);

    public function destroy($id);

    public function getComments($id);

}