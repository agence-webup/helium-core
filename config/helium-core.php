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
     * @config helium-core.resources determines how the package publishes
     * its resources (aka js/css/views) files.
     * For example, a js file will be located in `resources/js/$resources/`
     * ------------------------------------------------------------
     */
    'resources' => 'helium',

    'routing' => [
        /**
         * ------------------------------------------------------------
         *
         * @config helium-core.routing.filename determines the name of the file
         * containing helium routes. For example, `routes/admin.php`.
         * ------------------------------------------------------------
         */
        'filename' => 'helium',

        /**
         * ------------------------------------------------------------
         *
         * @config helium-core.routing.as determines how to reference the
         * published routes.
         * For example, `route('$as.about') == '/helium/about'`
         * ------------------------------------------------------------
         */
        'as' => 'helium::',

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

    'features' => [
        'users' => [
            /**
             * ------------------------------------------------------------
             *
             * @config helium-core.features.users.model_name determines the
             * name of the model.
             * ------------------------------------------------------------
             */
            'model_name' => 'HeliumUser',

            /**
             * ------------------------------------------------------------
             *
             * @config helium-core.features.users.table_name determines the
             * table to be created. Also determines where the pages will be located,
             * and determines the "as" (with an appended dot) and "prefix" of the routes.
             * ------------------------------------------------------------
             */
            'table_name' => 'helium_user',

            /**
             * ------------------------------------------------------------
             *
             * @config helium-core.features.users.controller_name determines
             * the name of the controller.
             * ------------------------------------------------------------
             */
            'controller_name' => 'HeliumUserController',

            /**
             * ------------------------------------------------------------
             *
             * @config helium-core.features.users.guard_name determines
             * the guard, declared in your config/auth.php file, that will
             * be used to encapsulate routes that require authentication.
             * ------------------------------------------------------------
             */
            'guard_name' => 'helium',
        ],
    ],
];
