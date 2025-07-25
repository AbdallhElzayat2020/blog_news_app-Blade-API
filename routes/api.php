<?php

use App\Http\Controllers\Api\Account\PostController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\RelatedNewsController;
use App\Http\Controllers\Api\Account\ProfileController;

Route::controller(HomeController::class)->prefix('posts')->group(function () {
    Route::get('/{keyword?}', 'getPosts')->middleware('throttle:getPosts');
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
Route::post('contact/store', [ContactController::class, 'storeContact'])->middleware('throttle:contact');

// ======================== ForgetPassword Routes ========================
Route::controller(ForgetPasswordController::class)->group(function () {
    Route::post('forget-password/email', 'forgetPassword')->middleware('throttle:forgetPassword');
});

// ======================== ResetPassword Routes ========================
Route::controller(ResetPasswordController::class)->middleware('throttle:resetPassword')->group(function () {
    Route::post('reset-password', 'resetPassword');
});

// ======================== Register Routes ========================
Route::post('auth/register', [RegisterController::class, 'register'])->middleware('throttle:register');

// ======================== Login Logout Routes ========================
Route::prefix('auth')->controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->middleware('throttle:login');
    Route::delete('/logout', 'logout')->middleware('auth:sanctum');
});

// ======================== Verify resend email Routes ========================
Route::controller(VerifyEmailController::class)->prefix('auth/email')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/verify', 'verifyEmail')->middleware('throttle:verify');
    Route::get('/resend', 'resendOtp')->middleware('throttle:resendOtp');
});

// ======================== Related news Routes ========================
Route::controller(RelatedNewsController::class)->prefix('related-news')->group(function () {
    Route::get('/', 'index');
});

Route::middleware(['auth:sanctum', 'verify_email'])->prefix('account')->group(function () {

    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    /*  Account setting  */
    Route::put('update-settings/{user_id}', [ProfileController::class, 'updateSettings']);
    Route::put('change-password/{user_id}', [ProfileController::class, 'changePassword']);

    // account/posts/
    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/', 'getUserPosts');
        Route::post('store/post', 'createUserPost');
        Route::delete('delete/post/{id}', 'deleteUserPost');
        Route::put('update/post/{id}', 'updateUserPost');

        // comment Routes
        Route::get('post/{id}/comments', 'getPostComments');
        Route::post('comments/store', 'storeComment');
    });


});
