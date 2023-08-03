<?php

namespace Webup\HeliumCore\Features\Definitions;

use Carbon\Carbon;
use Webup\HeliumCore\Commands\Publish;

class Migration extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $content = file_get_contents(__DIR__ . '/../../../database/migrations/' . $this->stub);
        if ($this->stub_processor !== null) {
            $content = ($this->stub_processor)($content);
        }
        $command->publish(
            $content,
            base_path('database/migrations/' . Carbon::now()->addSecond()->format('Y_m_d_His') . '_' . $this->filename)
        );
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
