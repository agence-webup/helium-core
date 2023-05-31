<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->prefix('/helium')->as('helium.')->group(function () {
    Route::middleware('auth:helium')->group(function () {
    });
});
