<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;

class EditPlan extends EditRecord
{
    protected static string $resource = PlanResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('plans')
                ->label('Plans')
                ->url(route('filament.resources.plans.index'))
                ->color('success')
                ->icon('heroicon-o-cube'),
            Actions\DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ];
    }
}
