<?php

namespace Webup\HeliumCore\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Webup\HeliumCore\HeliumCore
 *
 * @method static Closure getDefaultStubProcessor()
 */
class HeliumCore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\HeliumCore\HeliumCore::class;
    }
}
