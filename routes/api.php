<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\ImageApiController;
use App\Http\Controllers\Api\ProfileApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me', [AuthApiController::class, 'me']);
    Route::apiResource('users', UserApiController::class);
    Route::apiResource('categories', CategoryApiController::class);
    Route::apiResource('posts', PostApiController::class);
    Route::apiResource('galleries', GalleryApiController::class);
    Route::apiResource('images', ImageApiController::class);
    Route::apiResource('profiles', ProfileApiController::class);

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

Route::get('images/{filename}', [ImageApiController::class, 'showImage']);
