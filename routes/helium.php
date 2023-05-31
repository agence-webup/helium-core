<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('/helium')->as('helium::')->namespace('App\Http\Controllers\Helium')->group(function () {
    Route::get('/login', 'AuthController@showLoginForm')->name('login');
    Route::post('/login', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::middleware('auth:helium')->group(function () {
        // add admin routes
        Route::get('/', fn () => 'Plop!')->name('home');
    });
});
