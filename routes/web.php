<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\CheckRole;

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

// Routes for both Admin and User with manual middleware application
Route::middleware([CheckRole::class.':admin'])->group(function () {
     // Admin routes
     Route::get('admins', [AdminController::class, 'index'])->name('auth.user'); // Admin list or dashboard
     Route::get('admins/create', [AdminController::class, 'create'])->name('users.create'); // Admin creation form
     Route::post('admins', [AdminController::class, 'store'])->name('users.store'); // Store admin
     Route::get('admins/{user}/edit', [AdminController::class, 'edit'])->name('users.edit'); // Edit admin
     Route::put('admins/{user}', [AdminController::class, 'update'])->name('users.update'); // Update admin
     Route::delete('admins/{user}', [AdminController::class, 'destroy'])->name('users.destroy'); // Delete admin
     // Route to assign a user as admin
    Route::patch('users/{user}/assign', [AdminController::class, 'assign'])->name('users.assign');

    // Route to unassign a user from admin
    Route::patch('users/{user}/unassign', [AdminController::class, 'unassign'])->name('users.unassign');

});

Route::middleware([CheckRole::class.':user'])->group(function () {
    // User routes
    Route::get('users', [UserController::class, 'index'])->name('user.user'); // User list or dashboard
});


/* Route::resource('admins', AdminController::class);
Route::get('admins', [AdminController::class, 'index'])->name('auth.user');

Route::resource('users', UserController::class);
Route::get('users', [UserController::class, 'index'])->name('user.user')->middleware('IsAdmin'); */

Route::resource('posts', PostController::class);
Route::get('posts/{post}/comments', [PostController::class, 'comments'])->name('posts.comments.index');  // Add route for paginated comments

Route::resource('posts.comments', CommentController::class);
Route::get('posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('posts.comments.destroy');
Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('posts.comments.update');





