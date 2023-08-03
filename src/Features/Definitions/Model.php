<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Model extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $content = file_get_contents(__DIR__.'/../../Models/'.$this->stub);
        if ($this->stub_processor !== null) {
            $content = ($this->stub_processor)($content);
        }
        $command->publish(
            $content,
            base_path('app/Models/'.config('helium-core.namespace').'/'.$this->filename)
        );
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
