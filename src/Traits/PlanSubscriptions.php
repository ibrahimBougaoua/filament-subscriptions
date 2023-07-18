<?php

namespace IbrahimBougaoua\FilamentSubscription\Traits;
use IbrahimBougaoua\FilamentSubscription\Models\Feature;
use IbrahimBougaoua\FilamentSubscription\Models\PlanFeature;
use IbrahimBougaoua\FilamentSubscription\Models\PlanSubscription;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait PlanSubscriptions {

    public function planSubscriptions(): MorphMany
    {
        return $this->morphMany(PlanSubscription::class, 'subscriber', 'subscriber_type', 'subscriber_id');
    }

    public function newSubscription($name,$slug,$description,$trial_ends_at,$starts_at,$ends_at,$cancels_at,$canceled_at,$timezone,$plan_id) : PlanSubscription
    {
        return $this->planSubscriptions()->create([
            'name' => 'Test',
            'slug' => 'test',
            'description' => 'Test',
            'trial_ends_at' => '2023-07-15 18:55:38.000000',
            'starts_at' => '2023-07-15 18:55:38.000000',
            'ends_at' => '2023-07-15 18:55:38.000000',
            'cancels_at' => '2023-07-15 18:55:38.000000',
            'canceled_at' => '2023-07-15 18:55:38.000000',
            'timezone' => '',
            'plan_id' => 1,
        ]);
    }

    public function hasSubscribedTo($plan_id) : bool
    {
        $subscription = $this->planSubscriptions()->where('plan_id',$plan_id)->first();
        if( $subscription && $subscription->active() )
            return true;
        return false;
    }

    public function hasFeature($plan_id,$feature_id) : bool
    {
        $feature = PlanFeature::where('plan_id',$plan_id)->where('feature_id',$feature_id)->first();
        if( $feature )
            return true;
        return false;
    }
}