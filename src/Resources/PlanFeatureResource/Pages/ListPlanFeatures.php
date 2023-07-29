<?php

namespace IbrahimBougaoua\SubscriptionSystem\Resources\PlanFeatureResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use IbrahimBougaoua\SubscriptionSystem\Resources\PlanFeatureResource;

class ListPlanFeatures extends ListRecords
{
    protected static string $resource = PlanFeatureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
