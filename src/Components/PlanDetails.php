<?php

namespace IbrahimBougaoua\FilamentSubscription\Components;

use Filament\Forms\Components\Component;

class PlanDetails extends Component
{
    public $name;

    public $features;

    public function mount()
    {
    }

    public function render()
    {
        return view('filament-subscriptions::components.plan-details');
    }
}
