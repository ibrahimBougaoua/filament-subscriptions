<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use IbrahimBougaoua\FilamentSubscription\Models\PlanSubscription;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource;
use IbrahimBougaoua\FilamentSubscription\Widgets\SubscriptionsOverview;
use Illuminate\Database\Eloquent\Builder;

class ManagePlanSubscriptions extends ManageRecords
{
    protected static string $resource = PlanSubscriptionsResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('plans')
                ->label(__('ui.plans'))
                ->url(route('filament.admin.resources.plans.index'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
            Action::make('features')
                ->label(__('ui.features'))
                ->url(route('filament.admin.resources.features.index'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
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
