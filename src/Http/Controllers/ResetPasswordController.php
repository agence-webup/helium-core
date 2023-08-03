<?php

namespace App\Http\Controllers\Helium;

use Illuminate\Routing\Controller;
use Webup\LaravelHeliumCore\Traits\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
}
