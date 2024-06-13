<?php

namespace Webup\Helium\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Webup\Helium\Traits\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected function guard()
    {
        return Auth::guard(config('helium.auth.guard-name'));
    }

    public function showLoginForm()
    {
        return view('hui::pages.login');
    }

    public function redirectPath()
    {
        return route('helium::dashboard');
    }
}
