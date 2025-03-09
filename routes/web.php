<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'welcome');
});


Route::get('/test', [TestController::class,'someAction']);
Route::get('/home', [HomeController::class,'views']);