<?php

Route::get('/dashboard', function () {
    dd(session('success'));
})->name('dashboard');
