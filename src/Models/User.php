<?php

namespace App\Models\Helium;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'helium_users';

    protected array $hidden = [
        'password',
    ];

    protected $fillable = ['email', 'password'];
}
