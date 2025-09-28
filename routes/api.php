<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum','check.token.expiration'])->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::apiResource('articles',ArticleController::class);

    Route::get('articles/{article}/comments',[CommentController::class,'index']);
    Route::post('articles/{article}/comments',[CommentController::class,'store']);
});