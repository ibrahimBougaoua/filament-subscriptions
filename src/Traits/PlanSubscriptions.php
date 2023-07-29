<?php

namespace IbrahimBougaoua\SubscriptionSystem\Traits;

use Carbon\Carbon;
use IbrahimBougaoua\SubscriptionSystem\Models\Feature;
use IbrahimBougaoua\SubscriptionSystem\Models\Plan;
use IbrahimBougaoua\SubscriptionSystem\Models\PlanFeature;
use IbrahimBougaoua\SubscriptionSystem\Models\PlanSubscription;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait PlanSubscriptions
{
    public function planSubscriptions(): MorphMany
    {
        return $this->morphMany(PlanSubscription::class, 'subscriber', 'subscriber_type', 'subscriber_id');
    }

    public function newSubscription(Plan $plan): PlanSubscription
    {
        $startDate = Carbon::now();

        if ($plan->period == 'Monthly') {
            $endDate = $startDate->addMonth();
        } elseif ($plan->period == 'Yearly') {
            $endDate = $startDate->addYear();
        }

        return $this->planSubscriptions()->create([
            'name' => $plan->name,
            'slug' => $plan->slug,
            'description' => $plan->description,
            'price' => $plan->price,
            'trial_ends_at' => $plan->period == 'Trial' ? $startDate->addDays(7) : null,
            'starts_at' => $plan->period != 'Trial' ? $startDate : null,
            'ends_at' => $plan->period != 'Trial' ? $endDate : null,
            'plan_id' => $plan->id,
        ]);
    }

    public function planSubscription($slug): PlanSubscription
    {
        return $this->planSubscriptions()->where('slug', $slug)->first();
    }

    public function subscription(): PlanSubscription
    {
        return $this->planSubscriptions()->latest()->first();
    }

    public function hasSubscribed(): bool
    {
        $subscription = $this->planSubscriptions()->latest()->first();
        if ($subscription && $subscription->active()) {
            return true;
        }

        return false;
    }

    public function hasSubscribedTo($plan_id): bool
    {
        $subscription = $this->planSubscriptions()->where('plan_id', $plan_id)->latest()->first();
        if ($subscription && $subscription->active()) {
            return true;
        }

        return false;
    }

    public function hasFeature($plan_id, $feature_id): bool
    {
        $feature = PlanFeature::where('plan_id', $plan_id)->where('feature_id', $feature_id)->first();
        if ($feature) {
            return true;
        }

        return false;
    }

    public function getFeatureIdBySlug($slug): int
    {
        $feature = Feature::where('slug', $slug)->first();

        return $feature ? $feature->id : 0;
    }

    public function canUseFeature($slug): bool
    {
        $feature_id = $this->getFeatureIdBySlug($slug);

        if ($this->hasSubscribed() && $feature_id != 0) {
            $subscription = $this->planSubscriptions()->latest()->first();

            return $this->hasFeature($subscription->plan_id, $feature_id);
        }

        return false;
    }
}
