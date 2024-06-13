<?php

use Illuminate\Database\Migrations\Migration;
use Webup\Helium\Models\User;

return new class extends Migration
{
    protected string $name = 'Helium';

    protected string $email = 'user@helium.dev';

    protected string $password = 'password';

    public function up()
    {
        (new User([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]))->save();
    }

    public function down()
    {
        User::query()->where('email', $this->email)->delete();
    }
};
