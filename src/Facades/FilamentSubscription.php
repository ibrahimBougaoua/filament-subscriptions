<?php

namespace IbrahimBougaoua\SubscriptionSystem\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbrahimBougaoua\SubscriptionSystem\SubscriptionSystem
 */
class SubscriptionSystem extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \IbrahimBougaoua\SubscriptionSystem\SubscriptionSystem::class;
    }
}
