<?php

namespace IbrahimBougaoua\FilamentSubscription;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use IbrahimBougaoua\FilamentSubscription\Commands\FilamentSubscriptionCommand;

class FilamentSubscriptionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-subscriptions')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-subscriptions_table')
            ->hasCommand(FilamentSubscriptionCommand::class);
    }
}
