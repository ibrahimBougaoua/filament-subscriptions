<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource\Pages;

use App\Models\Domain;
use Carbon\Carbon;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
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
        return Domain::query()->whereMonth('created_at',Carbon::now()->month)->latest()->limit(1);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SubscriptionsOverview::class,
        ];
    }

}
