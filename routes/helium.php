<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->prefix('/helium')
    ->as('helium::')
    ->namespace('App\Http\Controllers\Helium')->group(function () {
        // * Helium publish marker - Do not remove this line *
    });
