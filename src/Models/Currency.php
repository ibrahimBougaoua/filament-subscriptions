<?php

namespace IbrahimBougaoua\FilamentSubscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'filament_currencies';

    protected $fillable = [
        'name',
        'icon',
        'code',
    ];

    public function plan()
    {
        return $this->hasMany(Plan::class, 'plan_id');
    }
}
