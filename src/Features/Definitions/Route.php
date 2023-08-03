<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;
use Webup\LaravelHeliumCore\Facades\LaravelHeliumCore;

class Route extends Step
{
    public function handle(Publish $command): void
    {
        // get the already published route file or the default one
        $app_route_path = base_path('routes/'.config('helium-core.routing.filename').'.php');
        $app_route = file_exists($app_route_path)
            ? file_get_contents($app_route_path)
            : LaravelHeliumCore::getDefaultStubProcessor()(file_get_contents(__DIR__.'/../../../routes/helium.php.stub'));

        // get the routes to publish
        $route = file_get_contents(__DIR__.'/../../../routes/'.$this->stub);
        $route .= "\n\n".$this->marker;
        if ($this->stub_processor !== null) {
            $route = ($this->stub_processor)($route);
        }

        // append the routes to the published file
        $app_route = str_replace($this->marker, $route, $app_route);

        $command->comment('Adding routes to '.$app_route_path);
        file_put_contents($app_route_path, $app_route);
    }
}
