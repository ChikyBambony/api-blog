<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware(['throttle:60,1'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

//Route::get('v1/posts', [PostController::class, 'index']);


Route::prefix('v1/{user}')->middleware(['throttle:60,1', 'auth:sanctum'])->group(function () {
    Route::apiResource('/posts', PostController::class);
//    Route::post('/posts/create', [PostController::class, 'store']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

