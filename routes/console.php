<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Http\Controllers\Api\EmergencyController;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule Emergency Radius Expansion every 5 minutes
Schedule::call(function () {
    app(EmergencyController::class)->expandRadius(new \Illuminate\Http\Request());
})->everyFiveMinutes();

// * * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
