<?php

use App\Http\Controllers\Api\HomeController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('posts', [HomeController::class, 'getPosts']);