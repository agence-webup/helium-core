<?php

namespace Webup\LaravelHeliumCore;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Webup\LaravelHeliumCore\Commands\Publish;

class LaravelHeliumCoreServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-helium-core')
            ->hasCommand(Publish::class);

        if (file_exists(base_path('routes/helium.php'))) {
            $this->loadRoutesFrom(base_path('routes') . '/helium.php');
        }
    }
}
