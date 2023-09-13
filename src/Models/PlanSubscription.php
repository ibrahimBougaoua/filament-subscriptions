<?php

namespace IbrahimBougaoua\FilamentSubscription\Models;

use Carbon\Carbon;
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
        'price',
        'period',
        'trial_ends_at',
        'starts_at',
        'ends_at',
        'cancels_at',
        'canceled_at',
        'timezone',
        'saw_it',
        'is_paid',
        'is_selected',
        'plan_id',
    ];

    protected $appends = ['canceled', 'trial_ends'];

    protected $attributes = [
        'is_selected' => true,
    ];

    public function subscriber(): MorphTo
    {
        return $this->morphTo('subscriber', 'subscriber_type', 'subscriber_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', true);
    }

    public function scopeUnPaid($query)
    {
        return $query->where('is_paid', false);
    }

    public function scopeTrial($query)
    {
        return $query->where('period', 'Trial');
    }

    public function getCanceledAttribute(): bool
    {
        return $this->canceled();
    }

    public function getTrialEndsAttribute(): bool
    {
        return ! $this->onFreeSubscription();
    }

    public function cancellation(): void
    {
        $this->canceled_at = Carbon::now();
        $this->save();
    }

    public function planState(): string
    {
        if ($this->active()) {
            return 'Actived';
        }

        if ($this->canceled()) {
            return 'Canceled';
        }

        if ($this->expired()) {
            return 'Expired';
        }

        return 'Canceled';
    }

    public function active(): bool
    {
        return (! $this->expired() || $this->onFreeSubscription()) && ! $this->canceled();
    }

    public function canceled(): bool
    {
        return $this->canceled_at ? true : false;
    }

    public function isFreeSubscription(): bool
    {
        return $this->trial_ends_at ? true : false;
    }

    public function onFreeSubscription(): bool
    {
        return $this->trial_ends_at ? Carbon::now()->lt($this->trial_ends_at) : false;
    }

    public function expired(): bool
    {
        return $this->ends_at ? Carbon::now()->gte($this->ends_at) : false;
    }
}
