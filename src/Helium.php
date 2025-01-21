<?php

namespace Webup\Helium;

use Illuminate\Support\Facades\Route;
use Webup\Helium\Models\User;

class Helium
{
    public function user(): ?User
    {
        /** @var User */
        $user = auth(config('helium-core.auth.guard-name'))->user();

        return $user;
    }

    public function route(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        return route(config('helium-core.route.as').$name, $parameters, $absolute);
    }

    public function isRoute(string $pattern): bool
    {
        return Route::is(config('helium-core.route.as').$pattern);
    }
}
