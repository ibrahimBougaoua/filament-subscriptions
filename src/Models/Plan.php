<?php

namespace IbrahimBougaoua\SubscriptionSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'filament_plans';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'signup_fee',
        'trial_period',
        'period',
        'active_subscribers_limit',
        'sort_order',
        'status',
        'currency_id',
    ];

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 'filament_plan_features');
    }

    public function subscriptions()
    {
        return $this->hasMany(PlanSubscription::class, 'plan_id');
    }
}
