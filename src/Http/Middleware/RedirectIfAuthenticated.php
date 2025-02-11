<?php

namespace Webup\Helium\Http\Middleware;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated as GuestMiddleware;
use Illuminate\Http\Request;
use Webup\Helium\Facades\HeliumCore;

class RedirectIfAuthenticated extends GuestMiddleware
{
    public static function using($guard, ...$others)
    {
        return static::class.':'.implode(',', [$guard, ...$others]);
    }

    protected function redirectTo(Request $request): ?string
    {
        return HeliumCore::route('dashboard');
    }
}
