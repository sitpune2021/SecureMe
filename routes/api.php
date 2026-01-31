<?php
// namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmergencyController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // send emergency signal
    Route::post('/emergency/signal', [EmergencyController::class, 'sendSignal']);
    Route::post('/signal/respond', [EmergencyController::class, 'respondSignal']);
    Route::post('/signal/expand', [EmergencyController::class, 'expandRadius']); // For scheduler


// });
