<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::resource('companies', CompanyController::class)->only(['index', 'create', 'store', 'destroy']);

Route::resource('companies.employees', EmployeeController::class)->only(['index', 'create', 'store']);
