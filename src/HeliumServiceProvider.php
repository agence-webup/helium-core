<?php

namespace Webup\Helium;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Webup\Helium\Models\User;

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

        $this->bootRoutes();

        $this->bootAuth();
    }

    public function register()
    {
        $this->app->bind('helium', fn () => new Helium);
        $this->app->bind('setting', fn () => new SettingManager);
    }

    /*
    |--------------------------------------------------------------------------
    | Private methods
    |--------------------------------------------------------------------------
    */

    protected function bootConfig()
    {
        $this->publishes([
            __DIR__.'/../config/helium.php' => config_path('helium.php'),
        ], 'helium');

        $this->mergeConfigFrom(__DIR__.'/../config/helium.php', 'helium');

    }

    protected function bootMigrations()
    {
        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'helium');
    }

    protected function bootAssets()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'helium');

        $this->publishes([
            __DIR__.'/../resources/js' => resource_path('js/vendor/helium'),
            __DIR__.'/../resources/css' => resource_path('css/vendor/helium'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/helium'),
        ], 'helium');
    }

    protected function bootRoutes()
    {
        $this->publishes([
            __DIR__.'/../routes/helium.php' => base_path('routes/helium.php'),
        ], 'helium');

        if (! App::runningInConsole()) {
            $this->loadRoutesFrom(__DIR__.'/../routes/_helium.php');
        }
    }

    protected function bootAuth()
    {
        $provider = Config::get('helium.auth.provider-name');
        Config::set("auth.providers.$provider", [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);

        $guard = Config::get('helium.auth.guard-name');
        Config::set("auth.guards.$guard", [
            'driver' => 'session',
            'provider' => $provider,
        ]);
    }
}
