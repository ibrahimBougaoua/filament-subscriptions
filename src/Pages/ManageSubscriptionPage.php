<?php

namespace IbrahimBougaoua\FilamentSubscription\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;

class ManageSubscriptionPage extends Page
{
    protected static ?string $navigationIcon = 'icon-subscription';

    protected static string $view = 'filament-subscriptions::pages.manage-subscription-page';

    public $subscriptions;

    public $name;

    public $price;

    public $period;

    public $description;

    public $isTrial;

    public $features;

    public function mount()
    {
        $this->getSubscribedPlan();
        $this->features = Feature::all();
        $this->subscriptions = auth()->user()->planSubscriptions()->latest()->get();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('ui.manage_subscriptions');
    }

    public static function getNavigationLabel(): string
    {
        return __('ui.manage_subscriptions');
    }

    public function getSubscribedPlan()
    {
        $subscription = auth()->user()->planSubscriptions()->latest()->first();
        if ($subscription) {
            $this->name = $subscription->name;
            $this->price = $subscription->price;
            $this->description = $subscription->plan->description;
            $this->period = $subscription->plan->period;
            $this->isTrial = $subscription->isFreeSubscription();
        }
    }

    protected function getActions(): array
    {
        return [
            Action::make('upgrade')
                ->label('Upgrade Plan')
                ->url(route('filament.admin.pages.plans-page'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
