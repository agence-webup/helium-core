<?php

namespace Webup\Helium\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use Webup\Helium\Models\User;

/**
 * @see \Webup\Helium\HeliumCore
 *
 * @method static Closure getDefaultStubProcessor()
 * @method static ?User user()
 * @method static string userClass()
 * @method static string route(string $name, mixed $parameters = [], bool $absolute = true)
 * @method static bool isRoute(string $pattern)
 */
class HeliumCore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\Helium\HeliumCore::class;
    }
}
