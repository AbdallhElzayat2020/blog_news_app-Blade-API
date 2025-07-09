<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('posts', [HomeController::class, 'getPosts']);