<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;

class ListPlans extends ListRecords
{
    protected static string $resource = PlanResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('features')
                ->label(__('ui.features'))
                ->url(route('filament.admin.resources.features.index'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
            Actions\CreateAction::make()
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
