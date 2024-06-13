<?php

namespace Webup\Helium;

use Webup\Helium\Models\User;

class Helium
{
    public function user(): ?User
    {
        /** @var User */
        $user = auth(config('helium.auth_guard'))->user();

        return $user;
    }
}
