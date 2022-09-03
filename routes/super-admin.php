<?php

use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\DashboardController;

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::resource('admins', AdminController::class)->only(['index', 'create', 'store', 'delete']);

