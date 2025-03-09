<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'welcome');
});


Route::get('/test', [TestController::class,'someAction']);
Route::get('/posts', [PostController::class,'index']);
Route::get('/posts/{post}',[PostController::class,'show']);