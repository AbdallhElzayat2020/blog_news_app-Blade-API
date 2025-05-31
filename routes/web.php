<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SearchController;

Route::group(
    ['as' => 'frontend.'],
    function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        /* contact Routes */
        Route::controller(ContactController::class)->prefix('contact')->name('contact.')->group(function () {
            Route::get('/', 'index')->name('show');
            Route::post('/store', 'submitForm')->name('form-submit');
        });

        Route::post('/news-subscribers', [NewsSubscribersController::class, 'index'])->name('news-subscribers.store');

        Route::get('category-post/{slug}', [CategoryController::class, 'index'])->name('category-posts');

        // Post Routes
        Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
            Route::get('/show/{slug}', 'index')->name('show');
            Route::get('/comments/{slug}', 'getAllComments')->name('comments');
            Route::post('/comments/store', 'storeComment')->name('comments.store');
        });

        /* search  */
        Route::match(['get', 'post'], 'search', SearchController::class)->name('search');
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
