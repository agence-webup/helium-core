<?php

return [
    /*
    |--------------------------------------------------------------------------
    | route-prefix
    |--------------------------------------------------------------------------
    |
    | The URL prefix for all helium routes.
    |
    */

    'route-prefix' => 'helium',

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
    | auth.*
    |--------------------------------------------------------------------------
    |
    | Configures authentication for helium.
    | Helium automatically declares its own guard and provider.
    |
    | guard-name: The name of the guard to use for authentication.
    | provider-name: The name of the provider used by the guard.
    */

    'auth' => [
        'guard-name' => 'helium',
        'provider-name' => 'users',
    ],
];
