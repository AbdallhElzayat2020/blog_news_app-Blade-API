<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;

Route::group(
    ['as' => 'frontend.'],
    function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::controller(ContactController::class)->prefix('contact')->name('contact.')->group(function () {
            Route::get('/', 'index')->name('show');
            Route::post('/store', 'submitForm')->name('form-submit');
        });

        Route::post('/news-subscribers', [NewsSubscribersController::class, 'index'])->name('news-subscribers.store');

        Route::get('category-post/{slug}', [CategoryController::class, 'index'])->name('category-posts');

        Route::get('show/post/{slug}', [PostController::class, 'index'])->name('post.show');


        Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
            Route::get('/comments/{slug}', 'getAllComments')->name('comments');
            Route::post('/comments/store', 'storeComment')->name('comments.store');
        });

    }
);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
