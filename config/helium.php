<?php

use Webup\Helium\Models\User;

return [
    'users' => [
        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | The model that is used to represent the Helium users.
        |
        */

        'model' => User::class,

        /*
        |--------------------------------------------------------------------------
        | Table
        |--------------------------------------------------------------------------
        |
        | The name of the table that stores the Helium users
        |
        */

        'table' => 'users',
    ],
];
