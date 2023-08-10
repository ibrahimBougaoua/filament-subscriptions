<?php

namespace IbrahimBougaoua\FilamentSubscription;

use Filament\PluginServiceProvider;
use IbrahimBougaoua\FilamentSubscription\Commands\FilamentSubscriptionCommand;
use Spatie\LaravelPackageTools\Package;

class FilamentSubscriptionServiceProvider extends PluginServiceProvider
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
            ->hasMigration('create_filament_subscriptions_table')
            ->hasCommand(FilamentSubscriptionCommand::class);
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('filament-subscriptions-tailwindcss-styles', __DIR__.'/../dist/css/style.css'),
        ], 'filament-subscriptions');
    }
}
