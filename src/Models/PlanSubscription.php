<?php

namespace IbrahimBougaoua\FilamentSubscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PlanSubscription extends Model
{
    use HasFactory;

    protected $table = 'filament_plan_subscriptions';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'cancels_at',
        'canceled_at',
        'timezone',
        'plan_id',
    ];

    public function subscriber() : MorphTo
    {
        return $this->morphTo('subscriber', 'subscriber_type' ,'subscriber_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id');
    }
}
