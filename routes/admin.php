<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\PasswordController;

/* Public Routes */

Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(LoginController::class)->group(function () {

        Route::get('/login', 'showLoginForm')->name('show-login-form')->middleware('guest.admin');

        Route::post('handle/login', 'handleLogin')->name('handle-login')->middleware('guest.admin');

        Route::post('/logout', 'logout')->name('logout')->middleware('auth.admin');
    });

    Route::controller(PasswordController::class)->middleware('guest.admin')->group(function () {
        Route::get('/forgot-password', 'forgotPassword')->name('forgot-password');
        Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');

    });
});


Route::get('test', function () {
    return view('admin.layouts.auth.password.reset-password');
});

/* Protected Routes */

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'auth.admin'])->group(function () {


    Route::get('dashboard', function () {
        return view('admin.index');
    })->name('dashboard.index');

});


Route::get('dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');
