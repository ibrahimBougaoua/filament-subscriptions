<?php

namespace IbrahimBougaoua\FilamentSubscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'subscriber',
        'plan_id',
    ];
}
