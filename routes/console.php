<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendVotingNotifications;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('competitions:send-voting-notifications', function () {
    $this->call('app:send-voting-notifications');
})->purpose('Send voting notifications to users when submission period ends');

Schedule::command(SendVotingNotifications::class)->daily();
