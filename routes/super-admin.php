<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuperAdmin\AdminController;

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::resource('admins', AdminController::class)->only(['index', 'create', 'store', 'destroy']);

Route::resource('companies', CompanyController::class);

Route::resource('companies.employees', EmployeeController::class);
