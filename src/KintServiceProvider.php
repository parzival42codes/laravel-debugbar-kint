<?php

namespace parzival42codes\LaravelKint;

use Barryvdh\Debugbar\Facades\Debugbar;
use parzival42codes\LaravelKint\App\Debugbar\DataCollector\KintCollector;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class KintServiceProvider extends PackageServiceProvider
{
    public const PACKAGE_NAME = 'laravel-kint';

    public const PACKAGE_NAME_SHORT = 'kint';

    public function configurePackage(Package $package): void
    {
        $package->name(self::PACKAGE_NAME)
            ->hasConfigFile();
    }

    public function registeringPackage(): void
    {
        if (config('kint.debugbar')) {
            Debugbar::addCollector(new KintCollector());
        }
    }
}
