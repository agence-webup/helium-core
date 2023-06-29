<?php

namespace App\Models\Helium;

use Illuminate\Foundation\Auth\User;

class HeliumUser extends User
{
    protected array $hidden = [
        'password',
    ];

    protected $fillable = ['email', 'password'];
}
