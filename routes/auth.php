<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->get('admin/test', function () {
    return view('hui::pages.test');
});
