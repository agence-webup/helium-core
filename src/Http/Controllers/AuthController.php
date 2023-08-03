<?php

namespace App\Http\Controllers\Helium;

use Illuminate\Routing\Controller;
use Webup\LaravelHeliumCore\Traits\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('pages.helium.user.login');
    }

    public function redirectPath()
    {
        return route('helium::home');
    }
}
