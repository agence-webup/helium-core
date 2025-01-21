<?php

namespace Webup\Helium;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Webup\Helium\Livewire\UserTable;
use Webup\Helium\Models\User;

class HeliumServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public const VENDOR_TAG = 'helium-core';

    public const PACKAGE_VERSION = '0.3.0';

    public function boot()
    {
        AboutCommand::add('webup/helium', fn () => [
            'Version' => self::PACKAGE_VERSION,
        ]);
        $this->bootConfig();
        $this->bootMigrations();
        $this->bootAssets();

        Livewire::component('helium-core::user-table', UserTable::class);

        $this->bootRoutes();

        $this->bootAuth();
    }

    public function register() {}

    /*
    |--------------------------------------------------------------------------
    | Private methods
    |--------------------------------------------------------------------------
    */

    protected function bootConfig()
    {
        $this->publishes([
            __DIR__.'/../config/helium-core.php' => config_path('helium-core.php'),
        ], self::VENDOR_TAG.'-config');

        $this->mergeConfigFrom(__DIR__.'/../config/helium-core.php', 'helium-core');
    }

    protected function bootMigrations()
    {
        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], self::VENDOR_TAG);
    }

    protected function bootAssets()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'helium-core');

        $this->publishes([
            __DIR__.'/../resources/js' => resource_path('js/vendor/helium-core'),
            __DIR__.'/../resources/css' => resource_path('css/vendor/helium-core'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/helium-core'),
        ], self::VENDOR_TAG);
    }

    protected function bootRoutes()
    {
        $this->publishes([
            __DIR__.'/../routes/helium.php' => base_path('routes/helium.php'),
        ], self::VENDOR_TAG);

        $this->loadRoutesFrom(__DIR__.'/../routes/_helium.php');
    }

    protected function bootAuth()
    {
        $provider = Config::get('helium-core.auth.provider-name');
        Config::set("auth.providers.$provider", [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);

        $guard = Config::get('helium-core.auth.guard-name');
        Config::set("auth.guards.$guard", [
            'driver' => 'session',
            'provider' => $provider,
        ]);
    }
}
