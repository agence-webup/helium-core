<?php

namespace Webup\HeliumCore;

use Closure;

class HeliumCore
{
    public function getDefaultStubProcessor(): Closure
    {
        return function (string $content): string {
            $content = str_replace('{{ $namespace }}', config('helium-core.namespace'), $content);
            $content = str_replace('{{ $resources }}', config('helium-core.resources'), $content);

            $content = str_replace('{{ $routing.as }}', config('helium-core.routing.as'), $content);
            $content = str_replace('{{ $routing.prefix }}', config('helium-core.routing.prefix'), $content);

            $content = str_replace('{{ $features.users.table_name }}', config('helium-core.features.users.table_name'), $content);
            $content = str_replace('{{ $features.users.model_name }}', config('helium-core.features.users.model_name'), $content);
            $content = str_replace('{{ $features.users.guard_name }}', config('helium-core.features.users.guard_name'), $content);
            $content = str_replace('{{ $features.users.controller_name }}', config('helium-core.features.users.controller_name'), $content);

            return $content;
        };
    }
}
