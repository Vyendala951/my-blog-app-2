<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\PostApiController;
// use App\Http\Controllers\Api\CategoryApiController;

use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/login', [Api\AuthController::class, 'login']);

// Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [Api\PostApiController::class, 'index']);
    Route::get('/posts/{post}', [Api\PostApiController::class, 'show']);
    Route::post('/posts', [Api\PostApiController::class, 'store']);
    Route::put('/posts/{post}', [Api\PostApiController::class, 'update']);
    Route::delete('/posts/{post}', [Api\PostApiController::class, 'destroy']);

    Route::get('/categories', [Api\CategoryApiController::class, 'index']);
    Route::get('/categories/{category}', [Api\CategoryApiController::class, 'show']);
    Route::post('/categories', [Api\CategoryApiController::class, 'store']);
    Route::put('/categories/{category}', [Api\CategoryApiController::class, 'update']);
    Route::delete('/categories/{category}', [Api\CategoryApiController::class, 'destroy']);

    // optional: logout
    Route::post('/logout', [Api\AuthController::class, 'logout']);
});
