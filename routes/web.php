<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::view('login', 'login')->name('login');
    Route::post('verify-credentials', [AuthController::class, 'login'])->name('verify-credentials');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth'])->withoutMiddleware('guest');
});
