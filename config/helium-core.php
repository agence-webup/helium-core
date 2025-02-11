<?php

use Webup\Helium\Models\User;

return [
    'route' => [
        /*
        |--------------------------------------------------------------------------
        | route.prefix
        |--------------------------------------------------------------------------
        |
        | The URL prefix for all helium routes.
        |
        */

        'prefix' => 'helium',

        /*
        |--------------------------------------------------------------------------
        | route.as
        |--------------------------------------------------------------------------
        |
        | The alias for all helium routes.
        |
        */

        'as' => 'helium::',
    ],

    /*
    |--------------------------------------------------------------------------
    | database.*
    |--------------------------------------------------------------------------
    |
    | Configures all database tables used by helium.
    |
    */

    'database' => [
        'users-table' => 'users',
        'settings-table' => 'settings',
    ],

    /*
    |--------------------------------------------------------------------------
    | models.*
    |--------------------------------------------------------------------------
    |
    | Configures all models used by helium.
    |
    */

    'models' => [
        'user' => User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | auth.*
    |--------------------------------------------------------------------------
    |
    | Configures authentication for helium.
    | Helium automatically declares its own guard and provider.
    |
    | enabled: Whether to declare the guard and provider.
    | guard-name: The name of the guard to use for authentication.
    | provider-name: The name of the provider used by the guard.
    */

    'auth' => [
        'enabled' => true,
        'guard-name' => 'helium',
        'provider-name' => 'users',
    ],
];
