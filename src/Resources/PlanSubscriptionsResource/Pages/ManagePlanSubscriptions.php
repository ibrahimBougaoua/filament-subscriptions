<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use IbrahimBougaoua\FilamentSubscription\Resources\PlanSubscriptionsResource;
use IbrahimBougaoua\FilamentSubscription\Widgets\SubscriptionsOverview;

class ManagePlanSubscriptions extends ManageRecords
{
    protected static string $resource = PlanSubscriptionsResource::class;

    protected function getActions(): array
    {
        return [
            
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SubscriptionsOverview::class,
        ];
    }

}
