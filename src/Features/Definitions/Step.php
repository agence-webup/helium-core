<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Closure;
use Webup\LaravelHeliumCore\Commands\Publish;

class Step
{
    public string $marker = '// * Helium publish marker - Do not remove this line *';

    public string $stub = '';

    public ?Closure $stub_processor = null;

    public static function make(): static
    {
        return new static();
    }

    public function handle(Publish $command): void
    {
        $command->info('Step '.static::class.' handled');
    }

    public function stub(string $stub): static
    {
        $this->stub = $stub;

        return $this;
    }

    public function stubProcessor(Closure $stub_processor): static
    {
        $this->stub_processor = $stub_processor;

        return $this;
    }
}
