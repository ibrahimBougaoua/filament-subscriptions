<?php

namespace IbrahimBougaoua\SubscriptionSystem\Components;

use Filament\Forms\Components\Component;

class Card extends Component
{
    public function render()
    {
        return view('filament-subscriptions::components.card');
    }
}