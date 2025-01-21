<?php

use Illuminate\Support\Facades\Route;

Route::as('helium::')
    ->prefix(config('helium.route-prefix'))
    ->middleware('web')
    ->group(function () {
        // perf(val): this serializes correctly with `artisan route:cache`
        //            so the check is executed once.
        if (file_exists(base_path('routes/helium.php'))) {
            include_once base_path('routes/helium.php');
        }
    });
