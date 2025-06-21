<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\User\UserController;

/* Public Routes */

Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(LoginController::class)->group(function () {

        Route::get('/login', 'showLoginForm')->name('show-login-form')->middleware('guest.admin');

        Route::post('handle/login', 'handleLogin')->name('handle-login')->middleware('guest.admin');

        Route::post('/logout', 'logout')->name('logout')->middleware('auth.admin');
    });

    Route::prefix('password')->name('password.')->middleware('guest.admin')->group(function () {
        /* Forget Password */
        Route::controller(ForgetPasswordController::class)->group(function () {
            Route::get('/forgot-password', 'forgotPassword')->name('forgot-password');
            Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');

            Route::get('show-otp-form/{email}', 'showOtpForm')->name('show-otp-form');
            Route::post('verify-otp-form', 'verifyOtpForm')->name('verify-otp-form');
        });

        /* Reset Password */
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('/reset-password/{email}', 'showResetPasswordForm')->name('show-reset-password-form');
            Route::post('/reset-password', 'ResetPassword')->name('reset-password');
        });

    });


});


/* Protected Routes */

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'auth.admin'])->group(function () {

    /* users */
    Route::resource('users', UserController::class);
    Route::post('user/block/status/{id}', [UserController::class, 'changeStatus'])->name('users.change-status');
    Route::get('dashboard', function () {
        return view('admin.index');
    })->name('dashboard.index');

});


Route::get('dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');
