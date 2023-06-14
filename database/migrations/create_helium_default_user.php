<?php

use App\Models\HeliumUser;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        (new HeliumUser([
            'email' => 'admin',
            'password' => bcrypt('changeme'),
        ]))->save();
    }

    public function down()
    {
        HeliumUser::query()->where('email', 'admin')->delete();
    }
};
