<?php

use IlluminateFoundationInspiring;
use IlluminateSupportFacadesArtisan;
use IlluminateSupportFacadesSchedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('subscriptions:check-reminders')->dailyAt('08:00')->withoutOverlapping();