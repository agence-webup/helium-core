<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $table = 'admin_users';

    protected $hidden = [
        'password',
    ];

    protected $fillable = ['email', 'password'];
}
