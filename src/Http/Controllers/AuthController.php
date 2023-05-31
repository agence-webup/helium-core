<?php

namespace Webup\LaravelHeliumCore\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('helium-core::pages.login');
    }

    public function redirectPath()
    {
        return route('helium::home');
    }
}
