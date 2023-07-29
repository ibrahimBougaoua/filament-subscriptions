<?php

namespace IbrahimBougaoua\SubscriptionSystem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanSubscriptionUsage extends Model
{
    use HasFactory;

    protected $table = 'filament_plan_subscription_usage';

    protected $fillable = [
        'used',
        'valid_until',
        'timezone',
        'subscription_id',
        'feature_id',
    ];
}
