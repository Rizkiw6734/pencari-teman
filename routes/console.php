<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\User;
use Carbon\Carbon;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::call(function () {
    $inactiveTime = now()->subMinutes(5);
    User::where('last_activity', '<', $inactiveTime)
        ->update(['is_online' => false]);
})->everyMinute();



