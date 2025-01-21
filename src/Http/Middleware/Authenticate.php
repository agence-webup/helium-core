<?php

namespace Webup\Helium\Http\Middleware;

use Exception;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Http\Request;
use Webup\Helium\Facades\Helium;

class Authenticate extends MiddlewareAuthenticate
{
    protected function redirectTo(Request $request)
    {
        if (Helium::isRoute('*')) {
            return Helium::route('login');
        }

        throw new Exception('Unauthenticated call.');
    }
}
