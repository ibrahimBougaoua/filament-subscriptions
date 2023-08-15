<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\FeatureResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use IbrahimBougaoua\FilamentSubscription\Resources\FeatureResource;

class ListFeatures extends ListRecords
{
    protected static string $resource = FeatureResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('plans')
                ->label('Plans')
                ->url(route('filament.admin.resources.plans.index'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
            Actions\CreateAction::make()
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
