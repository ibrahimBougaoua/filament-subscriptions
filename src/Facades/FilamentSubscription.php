<?php

namespace IbrahimBougaoua\FilamentSubscription\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbrahimBougaoua\FilamentSubscription\FilamentSubscription
 */
class FilamentSubscription extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \IbrahimBougaoua\FilamentSubscription\FilamentSubscription::class;
    }
}
