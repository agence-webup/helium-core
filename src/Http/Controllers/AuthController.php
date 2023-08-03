<?php

namespace App\Http\Controllers\Helium;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Webup\HeliumCore\Traits\AuthenticatesUsers;

/**
 * todo: stubify
 */
class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard('helium');
    }

    public function showLoginForm()
    {
        return view('pages.' . config('helium-core.resources') . '.user.login');
    }

    public function redirectPath()
    {
        return route(config('helium-core.routing.as') . '::home');
    }
}
