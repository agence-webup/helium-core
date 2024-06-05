<?php

namespace Webup\Helium;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class HeliumServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public function boot()
    {
        AboutCommand::add('webup/helium', fn () => [
            'Version' => '0.1.0',
        ]);
        $this->bootConfig();
        $this->bootMigrations();
        $this->bootAssets();
    }

    public function register()
    {
        $this->app->bind('helium', fn () => new Helium);
    }

    /*
    |--------------------------------------------------------------------------
    | Private methods
    |--------------------------------------------------------------------------
    */

    private function bootConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/helium.php', 'helium');

        $this->publishes([
            __DIR__.'/../config/helium.php' => config_path('helium.php'),
        ], 'helium-config');
    }

    private function bootMigrations()
    {
        // $this->publishesMigration();
    }

    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../resources/js' => resource_path('js/vendor/helium'),
            __DIR__.'/../resources/css' => resource_path('css/vendor/helium'),
        ], 'helium-assets');
    }
}
