<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
    ->prefix('admin')
    ->as('admin.')
    ->namespace('App\Http\Controllers\Admin')->group(function () {
        // * Helium publish marker - Do not remove this line *
    });
