<?php

namespace IbrahimBougaoua\FilamentSubscription;

use IbrahimBougaoua\FilamentSubscription\Commands\FilamentSubscriptionCommand;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanFeatureResource;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;
use Spatie\LaravelPackageTools\Package;
use Filament\PluginServiceProvider;

class FilamentSubscriptionServiceProvider extends PluginServiceProvider
{
    protected array $resources = [
        PlanResource::class,
        PlanFeatureResource::class,
    ];

    public function packageBooted(): void
    {
        parent::packageBooted();
    }

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
            ->hasMigration('create_filament_subscriptions_table')
            ->hasCommand(FilamentSubscriptionCommand::class);
    }
}
