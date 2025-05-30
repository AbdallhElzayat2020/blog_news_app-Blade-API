<?php

use Illuminate\Support\Facades\Route;


/* Public Routes */

Route::prefix('admin')->middleware(['guest'])->group(function () {
    //
});


/* Protected Routes */

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    //

});
