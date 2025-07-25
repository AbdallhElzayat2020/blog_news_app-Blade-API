<?php

use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SocialLoginController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;


/*
 * =======================
 *   Public Routes for User
 *  =======================
 */
Route::group(
    [
        'as' => 'frontend.'
    ],
    function () {


        Route::fallback(function () {
            return response()->view('errors.404');
        });

        Route::get('/', [HomeController::class, 'index'])->name('home');

        /* contact Routes */
        Route::controller(ContactController::class)->prefix('contact')->name('contact.')->group(function () {
            Route::get('/', 'index')->name('show');
            Route::post('/store', 'submitForm')->name('form-submit');
        });

        //send news subscribers
        Route::post('/news-subscribers', [NewsSubscribersController::class, 'index'])->name('news-subscribers.store');

        // Category Route
        Route::get('category-post/{slug}', [CategoryController::class, 'index'])->name('category-posts');

        // Post Routes
        Route::controller(PostController::class)->prefix('post')->name('post.')->group(function () {
            Route::get('/show/{slug}', 'index')->name('show');
            Route::get('/comments/{slug}', 'getAllComments')->name('comments')->middleware(['auth', 'verified']);
            Route::post('/comments/store', 'storeComment')->name('comments.store')->middleware(['auth', 'verified']);
        });

        Route::get('test', function () {
            $user = auth()->user();
            return view('frontend.dashboard.notifications', compact('user'));
        });

        /* search   */
        Route::match(['get', 'post'], 'search', SearchController::class)->name('search');

        /* waiting  */
        Route::get('/waiting', function () {
            return view('frontend.wait');
        })->name('waiting');
    }
);


/*
 * =======================
 *   Protected Routes for User
 *  =======================
 */
Route::prefix('account/dashboard')->name('frontend.dashboard.')->middleware(['auth', 'verified', 'check_user_status'])->group(function () {

    /* Dashboard && profile */
    Route::controller(ProfileController::class)->prefix('profile')->middleware(['check_user_status'])->group(function () {
        Route::get('/', 'index')->name('profile');
        Route::post('/store', 'store')->name('post.store');
        Route::delete('/delete/{id}', 'destroy')->name('profile.delete');
        Route::get('/get-comments/{id}', 'getComments')->name('profile.get-comments');

        Route::get('post/{slug}/edit', 'editPost')->name('profile.post-edit');
        Route::put('post/update', 'updatePost')->name('profile.post-update');

        Route::post('post/image/delete/{image_id}', 'deletePostImage')->name('post.image.delete');
    });

    /* Settings */
    Route::controller(SettingController::class)->prefix('settings')->middleware(['check_user_status'])->name('settings.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
        Route::post('change-password', 'changePassword')->name('change-password');
    });

    /*  Notifications */
    Route::controller(NotificationController::class)->prefix('notifications')->middleware(['check_user_status'])->name('notifications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/mark-all-read', 'markAllRead')->name('mark-all-read');
        Route::delete('/delete', 'delete')->name('delete');
        Route::get('/delete-all', 'deleteAll')->name('delete-all');
    });

});


/*  ============= Social login Routes ============= */

// Social Login Routes
Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('auth.socialite.callback');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
