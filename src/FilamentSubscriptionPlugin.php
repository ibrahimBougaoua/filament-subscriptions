<?php

declare(strict_types=1);

namespace IbrahimBougaoua\FilamentSubscription;

use Filament\Contracts\Plugin;
use Filament\Panel;
use IbrahimBougaoua\FilamentSubscription\Pages\ManageSubscriptionPage;
use IbrahimBougaoua\FilamentSubscription\Pages\PlansPage;
use IbrahimBougaoua\FilamentSubscription\Resources\FeatureResource;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource;
use IbrahimBougaoua\FilamentSubscription\Widgets\SubscriptionsOverview;

class FilamentSubscriptionPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filament-subscriptions';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                PlanResource::class,
                FeatureResource::class,
                PlanSubscriptionsResource::class,
            ])
            ->pages([
                ManageSubscriptionPage::class,
                PlansPage::class,
            ])
            ->widgets([
                SubscriptionsOverview::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
