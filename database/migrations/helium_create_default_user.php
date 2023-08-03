<?php

use App\Models\Helium\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        (new User([
            'email' => 'admin',
            'password' => bcrypt('changeme'),
        ]))->save();
    }

    public function down()
    {
        User::query()->where('email', 'admin')->delete();
    }
};
