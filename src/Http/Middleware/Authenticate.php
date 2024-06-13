<?php

namespace Webup\Helium\Http\Middleware;

use Exception;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Http\Request;

class Authenticate extends MiddlewareAuthenticate
{
    protected function redirectTo(Request $request)
    {
        if ($request->routeIs('helium::*')) {
            return route('helium::login');
        }

        throw new Exception('Unauthenticated call.');
    }
}
