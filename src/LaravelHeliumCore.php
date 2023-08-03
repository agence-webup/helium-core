<?php

namespace Webup\LaravelHeliumCore;

class LaravelHeliumCore
{
    public function getDefaultStubProcessor(): callable
    {
        return function (string $content): string {
            $content = str_replace('{{ $namespace }} ', config('helium-core.namespace'), $content);
            $content = str_replace('{{ $resources }} ', config('helium-core.resources'), $content);

            $content = str_replace('{{ $as }}', config('helium-core.routing.as'), $content);
            $content = str_replace('{{ $prefix }}', config('helium-core.routing.prefix'), $content);
            $content = str_replace(
                '{{ $middleware }}',
                sprintf(
                    "['%s']",
                    implode("', '", config('helium-core.routing.middleware'))
                ),
                $content
            );

            $content = str_replace('{{ $table_name }}', config('helium-core.features.users.table_name'), $content);
            $content = str_replace('{{ $model_name }}', config('helium-core.features.users.model_name'), $content);
            $content = str_replace('{{ $guard_name }}', config('helium-core.features.users.guard_name'), $content);
            $content = str_replace('{{ $controller_name }}', config('helium-core.features.users.controller_name'), $content);

            return $content;
        };
    }
}
