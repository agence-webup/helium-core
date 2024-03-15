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
            // $this->package->basePath('/../resources/views/datatable') => base_path('resources/views/vendor/hui/datatable'),
            // $this->package->basePath('/../resources/views/layout') => base_path('resources/views/vendor/hui/layout'),
        ], 'helium-components');

        $this->loadViewsFrom($this->package->basePath('/../resources/views'), 'hui');

        // $filename = config('helium-core.routing.filename');
        // $routes = base_path("routes/$filename.php");
        $routes = base_path('routes/admin.php');

        if (file_exists($routes)) {
            $this->loadRoutesFrom($routes);
        }
    }
}
