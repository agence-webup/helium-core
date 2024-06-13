<?php

use Illuminate\Support\Facades\Route;

Route::as('helium::')
    ->prefix(config('helium.route-prefix'))
    ->middleware('web')
    ->group(function () {
        include_once base_path('routes/helium.php');
    });
