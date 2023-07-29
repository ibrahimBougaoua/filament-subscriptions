<?php

namespace IbrahimBougaoua\SubscriptionSystem\Resources\PlanSubscriptionsResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use IbrahimBougaoua\SubscriptionSystem\Models\PlanSubscription;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanSubscriptionsResource;
use IbrahimBougaoua\SubscriptionSystem\Widgets\SubscriptionsOverview;
use Illuminate\Database\Eloquent\Builder;

class ManagePlanSubscriptions extends ManageRecords
{
    protected static string $resource = PlanSubscriptionsResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('plans')
                ->label('Plans')
                ->url(route('filament.resources.plans.index'))
                ->color('success')
                ->icon('heroicon-o-cube'),
            Action::make('features')
                ->label('Features')
                ->url(route('filament.resources.features.index'))
                ->color('success')
                ->icon('heroicon-o-tag'),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return PlanSubscription::query()->latest();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SubscriptionsOverview::class,
        ];
    }
}
