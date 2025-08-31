<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\LoginController;
use App\Http\controllers\DashboardController;
use App\Http\controllers\UserController;
use App\Http\controllers\SignalController;
use App\Http\controllers\EmergencyResponsesController;


Route::get('/admin/admin-login',[LoginController::class,'AdminLogin'])->name('admin.admin-login');
Route::post('/admin/save-login',[LoginController::class,'SaveLogin'])->name('admin.save-login');
Route::get('/admin/logout', [LoginController::class, 'Logout'])->name('admin.logout');

/// Protected Admin Routes
Route::middleware(['auth.admin'])->group(function () {

    Route::get('/admin/admin-dashboard',[DashboardController::class,'AdminDashboard'])->name('admin.dashboard');

    // Users Module
    Route::get('/admin/users-list',[UserController::class,'UsersList'])->name('admin.users-list');
    Route::get('/admin/users-details/{id}',[UserController::class,'UsersDetails'])->name('admin.users-details');


    // Emergency signal Module
    Route::get('/admin/all-emergency-signals',[SignalController::class,'AllEmergencySignalsList'])->name('admin.all-emergency-signals');

    // Emergency responses Module
    Route::get('/admin/all-emergency-responses',[EmergencyResponsesController::class,'AllEmergencyResponsesList'])->name('admin.all-emergency-responses');



});






