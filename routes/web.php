<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::middleware('api')->get('/protected', function () {
    return response()->json(['message' => 'You are authenticated']);
});

Auth::routes();

Route::resource('admins', AdminController::class);
Route::get('admins', [AdminController::class, 'index'])->name('auth.user');

Route::resource('users', UserController::class);
Route::get('users', [UserController::class, 'index'])->name('user.user')->middleware('IsAdmin');




