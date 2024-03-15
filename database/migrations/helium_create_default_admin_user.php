<?php

use App\Models\Admin\AdminUser;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        (new AdminUser([
            'email' => 'admin',
            'password' => bcrypt('password'),
        ]))->save();
    }

    public function down()
    {
        AdminUser::query()->where('email', 'admin')->delete();
    }
};
