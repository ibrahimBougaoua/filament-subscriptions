<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanResource;

class EditPlan extends EditRecord
{
    protected static string $resource = PlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
