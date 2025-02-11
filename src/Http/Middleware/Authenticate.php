<?php

namespace Webup\Helium\Http\Middleware;

use Exception;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
use Illuminate\Http\Request;
use Webup\Helium\Facades\HeliumCore;

class Authenticate extends MiddlewareAuthenticate
{
    protected function redirectTo(Request $request)
    {
        if (HeliumCore::isRoute('*')) {
            return HeliumCore::route('login');
        }

        throw new Exception('Unauthenticated call.');
    }
}
