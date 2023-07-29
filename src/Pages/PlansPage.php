<?php

namespace IbrahimBougaoua\SubscriptionSystem\Pages;

use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use IbrahimBougaoua\SubscriptionSystem\Models\Feature;
use IbrahimBougaoua\SubscriptionSystem\Models\Plan;

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

    public function switchPlan($plan_id)
    {
        if (auth()->user()->planSubscriptions()->count() != 0) {
            auth()->user()->subscription()->cancellation();
        }

        $plan = Plan::find($plan_id);
        $subscription = auth()->user()->newSubscription($plan);

        Notification::make()
            ->title('Switched to '.$subscription->name.' Plan successfully')
            ->success()
            ->send();

        return redirect()->route('filament.pages.manage-subscription-page');
    }

    public function allreadySubscribed()
    {
        Notification::make()
            ->title('This Plan allready Subscribed')
            ->success()
            ->send();
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
