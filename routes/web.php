<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\EmergencyResponsesController;
use App\Http\Controllers\InstantEmergencyGroupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;



Route::get('/', function () {
    return redirect()->route('admin.admin-login');
});
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

    // Routes for Instant emergency groups Module
    Route::get('/admin/instant-emergency-groups',[InstantEmergencyGroupController::class,'InstantEmergencyGroups'])->name('admin.instant-emergency-groups');

    // Routes for Reports Module
    Route::get('/admin/reports-and-logs',[ReportController::class,'ReportsAndLogsList'])->name('admin.reports-and-logs');

    // Routes for settings module
    Route::get('/admin/settings',[SettingsController::class,'settings'])->name('admin.settings');



});






