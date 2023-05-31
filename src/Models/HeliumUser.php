<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class HeliumUser extends User
{
    protected array $hidden = [
        'password',
    ];
}
