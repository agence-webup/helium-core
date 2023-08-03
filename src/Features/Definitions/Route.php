<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Route extends Step
{
    public string $filename;

    public function handle(Publish $command): void
    {
        // get the already published route file or the default one
        $app_route_path = base_path('routes/'.config('helium-core.routing.as').'.php');
        $app_route = file_exists($app_route_path)
            ? file_get_contents($app_route_path)
            : file_get_contents(__DIR__.'/../../../routes/helium.php');

        // get the routes to publish
        $route = file_get_contents(__DIR__.'/../../../routes/'.$this->filename);
        $route .= "\n\n".$this->marker;

        // append the routes to the published file
        $app_route = str_replace($this->marker, $route, $app_route);

        $command->comment('Adding routes to '.$app_route_path);
        file_put_contents($app_route_path, $app_route);
    }

    public function filename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
