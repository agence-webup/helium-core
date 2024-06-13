<?php

return [
    'route-prefix' => 'helium',

    'database' => [
        'users-table' => 'users',
    ],

    'auth' => [
        'guard-name' => 'helium',
        'provider-name' => 'users',
    ],
];
