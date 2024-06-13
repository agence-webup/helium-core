<?php

namespace Webup\Helium\Http\Middleware;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated as GuestMiddleware;
use Illuminate\Http\Request;

class RedirectIfAuthenticated extends GuestMiddleware
{
    public static function using($guard, ...$others)
    {
        return static::class.':'.implode(',', [$guard, ...$others]);
    }

    protected function redirectTo(Request $request): ?string
    {
        return route('helium::dashboard');
    }
}
