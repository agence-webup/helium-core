<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Carbon\Carbon;
use Webup\LaravelHeliumCore\Commands\Publish;

class Migration extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $command->publish(
            __DIR__.'/../../../database/migrations/'.$this->filename,
            base_path('database/migrations/'.Carbon::now()->addSecond()->format('Y_m_d_His').'_'.$this->filename)
        );
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
