<?php

namespace App\Interfaces;

interface UserPostProfileInterface
{
    public function index();

    public function store($request);

    public function edit($slug);

    public function update($slug);

    public function destroy($id);
}