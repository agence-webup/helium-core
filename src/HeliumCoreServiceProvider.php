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
            ->hasViews('helium-core')
            ->hasCommand(Publish::class);

        if (file_exists(base_path('routes/helium.php'))) {
            $this->loadRoutesFrom(base_path('routes') . '/helium.php');
        }
    }
}
