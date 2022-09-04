<?php

use App\Http\Controllers\DashboardController;

Route::get('dashboard', DashboardController::class)->name('dashboard');
