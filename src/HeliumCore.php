<?php

namespace Webup\Helium;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Webup\Helium\Models\User;

class HeliumCore
{
    public function user(): ?mixed
    {
        return auth(config('helium-core.auth.guard-name'))->user();
    }

    public function userClass(): string
    {
        return Config::get('helium-core.models.user', User::class);
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
