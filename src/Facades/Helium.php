<?php

namespace Webup\Helium\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use Webup\Helium\Models\User;

/**
 * @see \Webup\Helium\Helium
 *
 * @method static Closure getDefaultStubProcessor()
 * @method static ?User user()
 * @method static string route(string $name, mixed $parameters = [], bool $absolute = true)
 * @method static bool isRoute(string $pattern)
 */
class Helium extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\Helium\Helium::class;
    }
}
