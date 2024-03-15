<?php

namespace Webup\HeliumCore;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webup\HeliumCore\Commands\DatatableMakeCommand;
use Webup\HeliumCore\Commands\Publish;

class HeliumCoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('helium-core')
            ->hasConfigFile('helium-core')
            ->hasCommands(Publish::class, DatatableMakeCommand::class);

        $this->publishes([
            $this->package->basePath('/../resources/views/components') => base_path('resources/views/vendor/hui/components'),
        ], 'helium-components');

        $this->loadViewsFrom($this->package->basePath('/../resources/views'), 'hui');

        $routes = base_path('routes/admin.php');

        if (file_exists($routes)) {
            $this->loadRoutesFrom($routes);
        }
    }
}
