<?php

use Illuminate\Support\Facades\Route;
use Webup\Helium\Http\Controllers\AuthController;
use Webup\Helium\Http\Middleware\Authenticate;
use Webup\Helium\Http\Middleware\RedirectIfAuthenticated;

Route::middleware(RedirectIfAuthenticated::using(config('helium.auth.guard-name')))->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('postLogin');
});

Route::middleware(Authenticate::using(config('helium.auth.guard-name')))->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return 'helium dashboard';
    })->name('dashboard');
});
