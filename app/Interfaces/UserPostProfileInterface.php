<?php

namespace App\Interfaces;

interface UserPostProfileInterface
{
    public function index();

    public function store($request);
}