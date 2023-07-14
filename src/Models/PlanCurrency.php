<?php

namespace IbrahimBougaoua\FilamentSubscription\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCurrency extends Model
{
    use HasFactory;

    protected $table = 'filament_currencies';

    protected $fillable = [
        'name',
        'icon',
        'code',
    ];
}
