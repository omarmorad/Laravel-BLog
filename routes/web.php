<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'welcome');
});


Route::get('/test', [TestController::class,'someAction']);
Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('posts/create',[PostController::class,'create'])->name('posts.create');
Route::get('posts/edit/{post}',[PostController::class,'edit'])->name('posts.edit');
Route::put('posts/edit/{post}',[PostController::class,'update'])->name('posts.update');
Route::post('posts' , [PostController::class,'store'])->name('posts.store');
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

