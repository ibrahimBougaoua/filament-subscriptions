<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;

class EditPlan extends EditRecord
{
    protected static string $resource = PlanResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('plans')
                ->label(__('ui.plans'))
                ->url(route('filament.admin.resources.plans.index'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
            Actions\DeleteAction::make()
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
