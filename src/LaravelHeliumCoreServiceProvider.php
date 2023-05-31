<?php

namespace Webup\LaravelHeliumCore;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webup\LaravelHeliumCore\Commands\LaravelHeliumCoreCommand;
use Webup\LaravelHeliumCore\Models\HeliumUser;

class LaravelHeliumCoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-helium-core')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_helium_users_table')
            ->hasCommand(LaravelHeliumCoreCommand::class);

        $this->publishes([__DIR__.'/routes/helium.php' => base_path('routes/helium.php')], $package->shortName().'-routes');
        $this->publishes([__DIR__.'/Http/Controllers/AuthController.php' => base_path('App/Http/Controllers/Helium/AuthController.php')]);

        // Setup guard and provider for admin_users.
        $guards = $this->app['config']->get('auth.guards', []);
        $this->app['config']->set('auth.guards', array_merge([
            'helium' => ['driver' => 'session', 'provider' => 'helium_users'],
        ], $guards));
        $providers = $this->app['config']->get('auth.providers', []);
        $this->app['config']->set('auth.providers', array_merge([
            'helium_users' => ['driver' => 'eloquent', 'model' => HeliumUser::class],
        ], $providers));
    }
}
