<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsSubscribersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group(
    ['as' => 'frontend.'],
    function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::post('/news-subscribers', [NewsSubscribersController::class, 'index'])->name('news-subscribers.store');
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
