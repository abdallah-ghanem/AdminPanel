<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/greeting', function () {
    return 'Hello World';
});
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::middleware('api')->get('/protected', function () {
    return response()->json(['message' => 'You are authenticated']);
});

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');

    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json(['token' => $token]);
});

