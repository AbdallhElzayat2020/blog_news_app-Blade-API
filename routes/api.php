<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;

Route::controller(HomeController::class)->prefix('posts')->group(function () {
    Route::get('/{keyword?}', 'getPosts');
    Route::get('/show/{slug}', 'showPost');
    Route::get('/comments/{slug}', 'getPostComments');
});

// ======================== Settings Routes ========================
Route::controller(SettingController::class)->group(function () {
    Route::get('settings', 'getSettings');
    Route::get('related-sites', 'relatedSites');
});

// ======================== Categories Routes ========================
Route::controller(CategoryController::class)->group(function () {
    Route::get('categories', 'getCategories');
    Route::get('categories/{slug}/posts', 'getCategoryPosts');
});

// ======================== Contact Routes ========================
Route::post('contact/store', [ContactController::class, 'storeContact']);


/*
 * ===================================================
 * Protected Routes
 * ===================================================
 * */

// ======================== Register Routes ========================
Route::post('auth/register', [RegisterController::class, 'register']);


// ======================== Login Logout Routes ========================
Route::prefix('auth')->controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
    Route::delete('/logout', 'logout')->middleware('auth:sanctum');

});

// ======================== Verify email Routes ========================
Route::controller(VerifyEmailController::class)->prefix('auth/email')->middleware('auth:sanctum')->group(function () {
    Route::post('/verify', 'verifyEmail');
    Route::get('/resend', 'resendOtp');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});