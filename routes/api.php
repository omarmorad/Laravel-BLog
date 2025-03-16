<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use \App\Models\User;
use \Illuminate\Validation\ValidationException;
use \Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('posts', [PostController::class,'index']);
Route::get('posts/{post}', [PostController::class,'show']);
Route::post('posts' , [PostController::class,'store']);

Route::post('/sanctum/token', function(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password'=> 'required',
        'device_name'=>'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});