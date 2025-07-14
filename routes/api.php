<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;

Route::get('posts/{keyword?}', [HomeController::class, 'getPosts']);

Route::get('posts/show/{slug}', [HomeController::class, 'showPost']);

Route::get('settings', [SettingController::class, 'getSettings']);

Route::get('related-sites', [SettingController::class, 'relatedSites']);

Route::get('posts/comments/{slug}', [HomeController::class, 'getPostComments']);


Route::get('categories', [CategoryController::class, 'getCategories']);

Route::get('categories/{slug}/posts', [CategoryController::class, 'getCategoryPosts']);
