<?php

namespace App\Http\Controllers\Helium;

use Illuminate\Routing\Controller;
use Webup\LaravelHeliumCore\Traits\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
}
