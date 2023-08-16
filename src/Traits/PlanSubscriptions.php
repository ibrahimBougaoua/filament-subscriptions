<?php

namespace IbrahimBougaoua\FilamentSubscription\Traits;

use IbrahimBougaoua\FilamentSubscription\Models\Feature;
use IbrahimBougaoua\FilamentSubscription\Models\Plan;
use IbrahimBougaoua\FilamentSubscription\Models\PlanFeature;
use IbrahimBougaoua\FilamentSubscription\Models\PlanSubscription;
use IbrahimBougaoua\FilamentSubscription\Services\CalculateTime;
use IbrahimBougaoua\FilamentSubscription\Services\Period;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait PlanSubscriptions
{
    public function planSubscriptions(): MorphMany
    {
        return $this->morphMany(PlanSubscription::class, 'subscriber', 'subscriber_type', 'subscriber_id');
    }

    public function newSubscription(Plan $plan): PlanSubscription
    {
        $period = match($plan->period) {
            Period::Yearly->name => new CalculateTime('Yearly'),
            Period::Monthly->name => new CalculateTime('Monthly'),
            Period::Trial->name => new CalculateTime('Trial'),
            default => new CalculateTime('Trial'),
        };

        return $this->planSubscriptions()->create([
            'name' => $plan->name,
            'slug' => $plan->slug,
            'description' => $plan->description,
            'price' => $plan->price,
            'trial_ends_at' => $period->getTrialEndsAt(),
            'starts_at' => $period->startsAt(),
            'ends_at' => $period->endsAt(),
            'timezone' => '',
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
