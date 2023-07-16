<?php

namespace IbrahimBougaoua\FilamentSubscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    use HasFactory;

    protected $table = 'filament_plan_features';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'value',
        'resettable_period',
        'resettable_interval',
        'sort_order',
        'status',
        'plan_id',
    ];
    
    public function plan()
    {
        return $this->belongsTo(Plan::class,"plan_id");
    }
}
