<?php

namespace IbrahimBougaoua\FilamentSubscription\Pages;

use Filament\Pages\Page;
use Filament\Pages\Actions\Action;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;

class ManageSubscriptionPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-subscriptions::pages.manage-subscription-page';

    public $subscriptions;
    public $name;
    public $features;

    public function mount()
    {
        $this->name = "Golden";
        $this->features = Feature::all();
        $this->subscriptions = auth()->user()->planSubscriptions()->get();
    }

    protected function getActions(): array
    {
        return [
            Action::make('upgrade')
                ->label('Upgrade Plan')
                ->url(route('filament.pages.plans-page'))
                ->color('success')
                ->icon('heroicon-o-cube'),
        ];
    }
}
