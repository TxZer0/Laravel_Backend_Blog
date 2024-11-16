<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::prefix('v1')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('posts/{postId}/comments', [CommentController::class, 'index']);
    Route::get('search', [UserController::class, 'search']);

    Route::middleware('auth:sanctum')->group(function(){
        //users
        Route::post('upload', [UserController::class, 'uploadAvatar']);


        //posts
        Route::apiResource('posts', PostController::class);
        Route::post('posts/{postId}/upload', [PostController::class, 'upload']);
        Route::get('posts/{postId}/publish', [PostController::class, 'publish']);

        //comments
        Route::post('posts/{postId}/comments', [CommentController::class, 'store']);
        Route::patch('comments/{commentId}', [CommentController::class, 'update']);
        Route::delete('comments/{commentId}', [CommentController::class, 'destroy']);
        Route::post('comments/{commentId}/upload', [CommentController::class, 'upload']);

        //auth
        Route::get('logout', [AuthController::class, 'logout']);
    });
});
