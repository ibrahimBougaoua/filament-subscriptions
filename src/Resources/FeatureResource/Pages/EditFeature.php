<?php

namespace IbrahimBougaoua\FilamentSubscription\Resources\FeatureResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use IbrahimBougaoua\FilamentSubscription\Resources\FeatureResource;

class EditFeature extends EditRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
