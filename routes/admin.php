<?php

use Illuminate\Support\Facades\Route;


/* Public Routes */

// admin/
Route::middleware(['guest'])->group(function () {}); // admin.


/* Protected Routes */

Route::middleware(['auth', 'verified'])->group(function () {

    //

});


Route::get('dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');
