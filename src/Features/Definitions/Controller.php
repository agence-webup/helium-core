<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Controller extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $content = file_get_contents(__DIR__.'/../../Http/Controllers/'.$this->stub);
        if ($this->stub_processor) {
            $content = ($this->stub_processor)($content);
        }

        $command->publish(
            $content,
            base_path('app/Http/Controllers/'.config('helium-core.namespace').'/'.$this->filename)
        );
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
