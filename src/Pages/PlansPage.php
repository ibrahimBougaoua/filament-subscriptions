<?php

namespace IbrahimBougaoua\FilamentSubscription\Pages;

use Filament\Pages\Page;
use Filament\Pages\Actions\Action;
use IbrahimBougaoua\FilamentSubscription\Models\Plan;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;

class PlansPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-subscriptions::pages.plans-page';

    public $plans;
    public $features;

    public function mount()
    {
        $this->plans = Plan::get();
        $this->features = Feature::get();
    }

    protected function getActions(): array
    {
        return [
            Action::make('manage-subscription')
                ->label('Manage Subscription')
                ->url(route('filament.pages.manage-subscription-page'))
                ->color('success')
                ->icon('heroicon-o-cube'),
        ];
    }
}
