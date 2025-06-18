<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;


/* Public Routes */

Route::prefix('admin')->name('admin.')->middleware(['guest'])->group(function () {

    Route::controller(LoginController::class)->prefix('login')->group(function () {

        Route::get('/', 'showLoginForm')->name('show-login-form')->middleware('guest_admin');

        Route::post('/handle', 'handleLogin')->name('handle-login')->middleware('guest_admin');

        Route::post('/logout', 'logout')->name('logout')->middleware('auth:admin');
    });

});


/* Protected Routes */

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'verified'])->group(function () {

    Route::get('dashboard', function () {
        return view('admin.index');
    })->name('dashboard.index');

});


Route::get('dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');
