<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\UserPlatformController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Auth routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/{userId}', [UserController::class, 'getUserById'])->middleware('auth:sanctum');
    Route::get('/{userId}/posts', [PostController::class, 'getUserPosts'])->middleware('auth:sanctum');
    Route::post('login', [UserController::class, 'userLogin'])->middleware('auth:sanctum');
    Route::post('/', [UserController::class, 'createUser']);
    Route::delete('/{userId}/delete', [UserController::class, 'deleteUser'])->middleware('auth:sanctum');
    Route::put('/{userId}/update', [UserController::class, 'updateUser'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'posts'], function () {
    Route::post('/', [PostController::class, 'createPost'])->middleware('auth:sanctum');
    Route::put('/{postId}/update', [PostController::class, 'updateScheduledPost'])->middleware('auth:sanctum');
    Route::delete('/{postId}/delete', [PostController::class, 'deletePost'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'platforms'], function () {
    Route::get('/', [PlatformController::class, 'getAllPlatforms'])->middleware('auth:sanctum');
    Route::get('/platforms/analytics', [PlatformController::class, 'analytics'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'user-platforms'], function () {
    Route::get('/{userId}', [UserPlatformController::class, 'getUserPlatforms'])->middleware('auth:sanctum');
    Route::post('/{userId}/toggle', [UserPlatformController::class, 'togglePlatform'])->middleware('auth:sanctum');
});
