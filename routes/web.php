<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('site.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{slug}', [PostController::class, 'show'])->name('show')->where('slug', '[a-zA-Z0-9_-]+');
});

// Добавить middleware admin
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('index');
        Route::get('/create', [AdminPostController::class, 'create'])->name('create');
        Route::post('/', [AdminPostController::class, 'store'])->name('store');
    });

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{slug}', [AdminUserController::class, 'show'])->name('show')->where('slug', '[a-zA-Z0-9_-]+');
        Route::put('/{slug}/update', [AdminUserController::class, 'update'])->name('update')->where('slug', '[a-zA-Z0-9_-]+');
    });
});
