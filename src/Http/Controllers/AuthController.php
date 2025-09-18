<?php

namespace Webup\Helium\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Webup\Helium\Facades\HeliumCore;
use Webup\Helium\Traits\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard(config('helium-core.auth.guard-name'));
    }

    public function showLoginForm()
    {
        return view('helium-core::pages.login');
    }

    public function redirectPath()
    {
        return HeliumCore::route('dashboard');
    }
}
