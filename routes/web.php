<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Inertia\Inertia;
use App\Http\Controllers\CommentController;

Route::resource('posts', controller: PostController::class)->middleware('auth');
Route::resource('comments', CommentController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    // Update the show route to use ID instead of slug
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});

Route::post('posts', [PostController::class, 'store'])->name('posts.store');


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','admins-only'])->group(function () {
    Route::get('/profile',[ProfileController::class, 'edit'] )->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Add this with your other routes
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
