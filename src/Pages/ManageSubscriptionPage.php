<?php

namespace IbrahimBougaoua\SubscriptionSystem\Pages;

use Filament\Pages\Page;
use Filament\Pages\Actions\Action;
use IbrahimBougaoua\SubscriptionSystem\Models\Feature;

class ManageSubscriptionPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-subscriptions::pages.manage-subscription-page';

    public $subscriptions;
    public $name;
    public $price;
    public $trial_interval;
    public $description;
    public $isTrial;
    public $features;

    public function mount()
    {
        $this->getSubscribedPlan();
        $this->features = Feature::all();
        $this->subscriptions = auth()->user()->planSubscriptions()->latest()->get();
    }

    public function getSubscribedPlan()
    {
        $subscription = auth()->user()->planSubscriptions()->latest()->first();
        if( $subscription )
        {
            $this->name = $subscription->name;
            $this->price = $subscription->price;
            $this->description = $subscription->plan->description;
            $this->trial_interval = $subscription->plan->trial_interval;
            $this->isTrial = $subscription->isFreeSubscription();
        }
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