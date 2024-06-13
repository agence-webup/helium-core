<?php

use Illuminate\Support\Facades\Route;
use Webup\Helium\Http\Controllers\AuthController;
use Webup\Helium\Http\Controllers\SettingController;
use Webup\Helium\Http\Controllers\UserController;
use Webup\Helium\Http\Middleware\Authenticate;
use Webup\Helium\Http\Middleware\RedirectIfAuthenticated;

Route::middleware(RedirectIfAuthenticated::using(config('helium.auth.guard-name')))->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('postLogin');
});

Route::middleware(Authenticate::using(config('helium.auth.guard-name')))->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return 'helium dashboard';
    })->name('dashboard');

    Route::prefix('users')->as('user.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');

        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::post('/{user}', 'update')->name('update');

        Route::delete('/{user}', 'destroy')->name('destroy');
    });

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
});
