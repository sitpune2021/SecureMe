<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\LoginController;
use App\Http\controllers\DashboardController;
use App\Http\controllers\UserController;


Route::get('/admin/admin-login',[LoginController::class,'AdminLogin'])->name('admin.admin-login');
Route::post('/admin/save-login',[LoginController::class,'SaveLogin'])->name('admin.save-login');

// Route::middleware(['authGroup'])->group(function () {

    Route::get('/admin/admin-dashboard',[DashboardController::class,'AdminDashboard'])->name('admin.dashboard');

    // Users Module
    Route::get('/admin/users-list',[UserController::class,'UsersList'])->name('admin.users-list');

// });






