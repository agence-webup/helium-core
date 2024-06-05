<?php

namespace Webup\Helium\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Webup\Helium\Helium
 *
 * @method static Closure getDefaultStubProcessor()
 */
class Helium extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\Helium\Helium::class;
    }
}
