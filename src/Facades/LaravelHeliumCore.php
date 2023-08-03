<?php

namespace Webup\LaravelHeliumCore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Webup\LaravelHeliumCore\LaravelHeliumCore
 *
 * @method static callable getDefaultStubProcessor()
 */
class LaravelHeliumCore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\LaravelHeliumCore\LaravelHeliumCore::class;
    }
}
