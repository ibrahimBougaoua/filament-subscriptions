<?php

namespace IbrahimBougaoua\SubscriptionSystem;

use Filament\PluginServiceProvider;
use IbrahimBougaoua\SubscriptionSystem\Commands\SubscriptionSystemCommand;
use IbrahimBougaoua\SubscriptionSystem\Pages\ManageSubscriptionPage;
use IbrahimBougaoua\SubscriptionSystem\Pages\PlansPage;
use IbrahimBougaoua\SubscriptionSystem\Resources\FeatureResource;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanResource;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanSubscriptionsResource;
use IbrahimBougaoua\SubscriptionSystem\Widgets\SubscriptionsOverview;
use Spatie\LaravelPackageTools\Package;

class SubscriptionSystemServiceProvider extends PluginServiceProvider
{
    protected array $styles = [
        'tailwindcss-styles' => __DIR__.'/../dist/css/style.css',
    ];

    protected array $resources = [
        PlanResource::class,
        FeatureResource::class,
        PlanSubscriptionsResource::class,
    ];

    protected array $pages = [
        ManageSubscriptionPage::class,
        PlansPage::class,
    ];

    protected array $widgets = [
        SubscriptionsOverview::class,
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
            ->hasCommand(SubscriptionSystemCommand::class);
    }
}
