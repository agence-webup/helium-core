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
        $package
            ->name('laravel-helium-core')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_helium_users_table')
            ->hasCommand(LaravelHeliumCoreCommand::class);

        $this->publishes([__DIR__.'/../routes/helium.php' => base_path('routes/helium.php')], $package->shortName().'-routes');

        if (file_exists(base_path('routes/helium.php'))) {
            $this->loadRoutesFrom(base_path('routes').'/helium.php');
        }

        $this->publishes([
            __DIR__.'/Http/Controllers/AuthController.php' => base_path('app/Http/Controllers/Helium/AuthController.php'),
            __DIR__.'/Http/Controllers/ForgotPasswordController.php' => base_path('app/Http/Controllers/Helium/ForgotPasswordController.php'),
            __DIR__.'/Http/Controllers/ResetPasswordController.php' => base_path('app/Http/Controllers/Helium/ResetPasswordController.php'),
        ], $package->shortName().'-controllers');

        $this->publishes([
            __DIR__.'/Models/HeliumUser.php' => base_path('app/Models/HeliumUser.php'),
        ], $package->shortName().'-models');

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
