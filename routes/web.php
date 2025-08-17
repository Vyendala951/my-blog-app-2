<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    // Redirect default / to /admin
    Route::get('/', function () {
        return redirect('/admin/posts/all');
    });

    // Post routes
    Route::get('/posts/all', [PostController::class, 'index'])->name('posts.all');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/save', [PostController::class, 'save'])->name('posts.save');
    Route::get('/posts/delete/{post}', [PostController::class, 'delete'])->name('posts.delete');

    // Category routes
    Route::get('/categories/all', [CategoryController::class, 'index'])->name('categories.all');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/save', [CategoryController::class, 'save'])->name('categories.save');
    Route::get('/categories/delete/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
});