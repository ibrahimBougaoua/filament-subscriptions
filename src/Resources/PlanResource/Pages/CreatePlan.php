<?php

namespace IbrahimBougaoua\SubscriptionSystem\Resources\PlanResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanResource;

class CreatePlan extends CreateRecord
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
        ];
    }
}
