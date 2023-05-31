<?php

namespace Webup\LaravelHeliumCore\Models;

use Illuminate\Foundation\Auth\User;

class HeliumUser extends User
{
    protected array $hidden = [
        'password',
    ];
}
