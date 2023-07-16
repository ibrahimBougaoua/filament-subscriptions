<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;

class ListPlans extends ListRecords
{
    protected static string $resource = PlanResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('features')
                ->label('Features')
                ->url(route('filament.resources.features.index'))
                ->color('success')
                ->icon('heroicon-o-tag'),
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
