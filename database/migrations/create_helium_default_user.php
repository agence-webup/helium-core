<?php

use App\Models\HeliumUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
