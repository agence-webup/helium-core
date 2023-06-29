<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Step
{
    public string $marker = '// * Helium publish marker - Do not remove this line *';

    public static function make(): static
    {
        return new static();
    }

    public function handle(Publish $command): void
    {
        $command->info('Step '.static::class.' handled');
    }
}
