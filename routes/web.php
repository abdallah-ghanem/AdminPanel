<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::middleware('api')->get('/protected', function () {
    return response()->json(['message' => 'You are authenticated']);
});
Route::get('/login', function () {
    return 'Hello login page';
});

Route::post('/login', [AuthController::class, 'login']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('user/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');
