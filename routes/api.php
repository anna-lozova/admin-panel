<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', [\App\Http\Controllers\UserController::class, 'show']);

Route::get('/users/{id}', [\App\Http\Controllers\UserController::class, 'getById']);

Route::post('/users', [\App\Http\Controllers\UserController::class, 'create']);

Route::put('/users/{id}', [\App\Http\Controllers\UserController::class, 'update']);

Route::delete('/users/{id}', [\App\Http\Controllers\UserController::class, 'delete']);

Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'show']);

Route::get('/change-role', [\App\Http\Controllers\UserController::class, 'changeRole']);

Route::get('/redirect', [\App\Http\Controllers\UserController::class, 'redirectToProvider']);

Route::get('/callback', [\App\Http\Controllers\UserController::class, 'handleProviderCallback']);
