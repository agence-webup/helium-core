<?php

namespace Webup\HeliumCore;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webup\HeliumCore\Commands\Publish;

class HeliumCoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('helium-core')
            ->hasConfigFile('helium-core')
            ->hasViews('hui')
            ->hasCommand(Publish::class);

        $filename = config('helium-core.routing.filename');
        $routes = base_path("routes/{$filename}.php");
        if (file_exists($routes)) {
            $this->loadRoutesFrom($routes);
        }
    }
}
