<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/signup','signup');
    Route::post('/auth/signin', 'signin');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/signout', 'signout');
    });
});

Route::controller(ProfileController::class)->group(function () {
   Route::middleware('auth:sanctum')->group(function () {
       Route::get('/user/profile', 'show');
       Route::post('/user/profile', 'update');
       Route::post('/user/profile/password', 'updatePassword');
   });
});

Route::controller(PostController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/post', 'index');
        Route::post('/post', 'store');
        Route::post('/post/{post}/update', 'update');
        Route::post('/post/{post}/delete', 'delete');

        Route::post('/post/{post}/like', 'like');
        Route::post('/post/{post}/unlike', 'unlike');
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/comment/{post}', 'index');
        Route::post('/comment/{post}', 'store');
        Route::post('/comment/{post}/update', 'update');
        Route::post('/comment/{post}/delete', 'delete');
    });
});
