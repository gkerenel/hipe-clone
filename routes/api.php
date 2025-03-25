<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/signup','signup');
    Route::post('/signin', 'signin');
    Route::get('/test', 'test');

    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/signout', 'signout');
    });
});

Route::controller(ProfileController::class)->group(function () {
   Route::middleware('auth:sanctum')->group(function () {
       Route::get('/profile', 'show');
       Route::put('/profile/update', 'update');
       Route::put('/profile/updatePassword', 'updatePassword');
   });
});

Route::controller(UserController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/{user}', 'index');
    });
});

Route::controller(PostController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/post', 'show');
        Route::post('/post', 'store');
        Route::get('/post/{post}', 'index');
        Route::put('/post/{post}', 'update');
        Route::delete('/post/{post}', 'delete');
    });
});

Route::controller(LikeController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/like/{post}/like', 'like');
        Route::get('/like/{post}/unlike', 'unlike');
        Route::get('/like/{post}/isLiked', 'isLiked');
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/comment/{post}', 'index');
        Route::post('/comment/{post}', 'store');
        Route::put('/comment/{comment}', 'update');
        Route::delete('/comment/{comment}', 'delete');
    });
});

Route::controller(FollowController::class)->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/follow/{user}/follow', 'follow');
        Route::get('/follow/{user}/unfollow', 'unfollow');
        Route::get('/follow/{user}', 'isFollowing');
    });
});
