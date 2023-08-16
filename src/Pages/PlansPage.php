<?php

namespace IbrahimBougaoua\FilamentSubscription\Pages;

use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Filament\Pages\Page;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;
use IbrahimBougaoua\FilamentSubscription\Models\Plan;

class PlansPage extends Page
{
    protected static ?string $navigationIcon = 'icon-plan';
    
    protected static string $view = 'filament-subscriptions::pages.plans-page';

    public $plans;

    public $features;

    public function mount()
    {
        $this->plans = Plan::get();
        $this->features = Feature::get();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('ui.manage_subscriptions');
    }

    public static function getNavigationLabel(): string
    {
        return __('ui.plans');
    }

    public function switchPlan($plan_id)
    {
        if (auth()->user()->planSubscriptions()->count() != 0) {
            auth()->user()->subscription()->cancellation();
        }

        $plan = Plan::find($plan_id);
        $subscription = auth()->user()->newSubscription($plan);

        Notification::make()
            ->title(__('ui.switched_to') . ' '.$subscription->name. ' ' . __('ui.plan_successfully'))
            ->success()
            ->send();

        return redirect()->route('filament.admin.pages.manage-subscription-page');
    }

    protected function getActions(): array
    {
        return [
            Action::make('manage-subscription')
                ->label(__('ui.manage_subscription'))
                ->url(route('filament.admin.pages.manage-subscription-page'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
