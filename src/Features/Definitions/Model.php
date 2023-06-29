<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Model extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $command->publish(
            __DIR__ . '/../../Models/' . $this->filename,
            base_path('app/Models/Helium/' . $this->filename)
        );
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
