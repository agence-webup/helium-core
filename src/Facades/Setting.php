<?php

namespace Webup\Helium\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Webup\Helium\SettingManager
 *
 * @method static Closure getDefaultStubProcessor()
 * @method static ?string get(string $key, ?string $default)
 * @method static void set(string $key, mixed $value)
 * @method static array all()
 */
class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\Helium\SettingManager::class;
    }
}
