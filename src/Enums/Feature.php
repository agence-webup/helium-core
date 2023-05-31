<?php

namespace Webup\LaravelHeliumCore\Enums;

enum Feature: string
{
    case AUTH = 'auth';

    public function label(): string
    {
        return match ($this) {
            static::AUTH => 'authentication',
        };
    }
}
