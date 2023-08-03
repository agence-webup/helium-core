<?php

namespace Webup\HeliumCore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Webup\HeliumCore\HeliumCore
 *
 * @method static string getDefaultStubProcessor(string $content)
 */
class HeliumCore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Webup\HeliumCore\HeliumCore::class;
    }
}
