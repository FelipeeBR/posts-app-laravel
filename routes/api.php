<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthController::class, 'auth']);

Route::post('/user', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);

    Route::post('/post', [PostsController::class, 'store']);
    Route::put('/post/{post}', [PostsController::class, 'update']);
    Route::get('/post/{post}', [PostsController::class, 'view']);
    Route::get('/post', [PostsController::class, 'index']);
    Route::delete('/post/{post}', [PostsController::class, 'delete']);
});