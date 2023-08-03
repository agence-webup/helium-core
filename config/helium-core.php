<?php

// config for Webup/LaravelHeliumCore

return [
    /**
     * ------------------------------------------------------------
     *
     * @config helium-core.namespace determines how the package publishes its php files.
     * For example, a controller will be located in `App\Http\Controllers\$namespace`
     * ------------------------------------------------------------
     */
    'namespace' => 'Helium',

    /**
     * ------------------------------------------------------------
     *
     * @config helium-core.resources determines how the package publishes its resources (aka js/css/views) files.
     * For example, a js file will be located in `resources/js/$resources/`
     * ------------------------------------------------------------
     */
    'resources' => 'helium',

    'routing' => [
        /**
         * ------------------------------------------------------------
         *
         * @config helium-core.routing.as determines how to reference the published routes.
         * For example, `route('$as.about') == '/helium/about'`
         * ------------------------------------------------------------
         */
        'as' => 'helium',

        /**
         * ------------------------------------------------------------
         *
         * @config helium-core.routing.prefix determines the url prefix
         * of the published routes.
         * For example, `route('helium.about') == '/$prefix/about'`
         * ------------------------------------------------------------
         */
        'prefix' => env('HELIUM_ROUTING_PREFIX', 'helium'),

        /**
         * ------------------------------------------------------------
         *
         * @config helium-core.routing.middleware determines the middlewares
         * used by all the routes published by the package.
         * ------------------------------------------------------------
         */
        'middleware' => ['web'],
    ],

    // * Helium publish marker - Do not remove this line *
];
