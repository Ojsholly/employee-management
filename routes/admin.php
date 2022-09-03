<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CompanyController;

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::resource('companies', CompanyController::class)->only(['index', 'create', 'store', 'destroy']);
