<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::resource('posts', PostController::class);
Route::resource('posts.comments', CommentController::class);
Route::get('posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('posts.comments.destroy');




