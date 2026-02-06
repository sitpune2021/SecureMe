<?php
// namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmergencyController;

// Route::post('/auth/register', [AuthController::class, 'register']);
// Route::post('/auth/login', [AuthController::class, 'login']);
// Route::get('/user/profile', [AuthController::class, 'profile']);

// Route::post('auth/logout', [AuthController::class, 'logout']);
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user/profile', [AuthController::class, 'profile']);
// });

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});










Route::middleware('auth:sanctum')->group(function () {

    // send emergency signal
    Route::post('/emergency/signal', [EmergencyController::class, 'sendSignal']);
    Route::post('/signal/respond', [EmergencyController::class, 'respondSignal']);
    Route::post('/signal/expand', [EmergencyController::class, 'expandRadius']); // For scheduler


});
