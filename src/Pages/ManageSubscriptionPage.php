<?php

namespace IbrahimBougaoua\FilamentSubscription\Pages;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Pages\Page;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;
use IbrahimBougaoua\FilamentSubscription\Models\PlanSubscription;

class ManageSubscriptionPage extends Page
{
    protected static ?string $navigationIcon = 'icon-subscription';

    protected static string $view = 'filament-subscriptions::pages.manage-subscription-page';

    public $subscription_id;

    public $saw_it = false;

    public $message;

    public $subscriptions;

    public $name;

    public $price;

    public $period;

    public $description;

    public $isTrial;

    public $isPaid;

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
            $this->subscription_id = $subscription->id;
            $this->name = $subscription->name;
            $this->price = $subscription->price;
            $this->description = $subscription->plan->description;
            $this->period = $subscription->plan->period;
            $this->isTrial = $subscription->isFreeSubscription();
            $this->isPaid = $subscription->is_paid;

            if ($subscription->saw_it) {
                $this->saw_it = true;
            }

            if ($this->isPaid || $this->isTrial) {
                $this->message = __('ui.the_currently_active_subscription').' '.$this->name;
            } else {
                $this->message = __('ui.your_plan_subscription_has_created_successfully');
            }
        }
    }

    public function sawIt()
    {
        $subscription = PlanSubscription::find($this->subscription_id);
        if ($subscription) {
            $subscription->saw_it = Carbon::now();
            $subscription->save();
            $this->saw_it = true;
        }
    }

    protected function getActions(): array
    {
        return [
            Action::make('upgrade')
                ->label(__('ui.upgrade_plan'))
                ->url(route('filament.admin.pages.plans-page'))
                ->color('success')
                ->icon('heroicon-o-rectangle-stack'),
        ];
    }
}
