<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Controller extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $command->publish(
            __DIR__.'/../../Http/Controllers/'.$this->filename,
            base_path('app/Http/Controllers/Helium/'.$this->filename)
        );
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
