<?php

namespace Webup\LaravelHeliumCore\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Routing\Controller;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLoginForm()
    {
        return view('helium-core::pages.login');
    }

    public function redirectPath()
    {
        return route('helium::home');
    }
}
