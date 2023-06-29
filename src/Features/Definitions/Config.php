<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Config extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        $app_config_path = base_path('config/helium-core.php');
        $app_config = file_exists($app_config_path)
            ? file_get_contents($app_config_path)
            : file_get_contents(__DIR__.'/../../../config/helium-core.php');

        $config = file_get_contents(__DIR__.'/../../../config/'.$this->filename);

        $config .= "\n\n".$this->marker;

        $app_config = str_replace($this->marker, $config, $app_config);

        $command->comment('Adding config to '.$app_config_path);
        file_put_contents($app_config_path, $app_config);
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
