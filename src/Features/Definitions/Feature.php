<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Feature
{
    public static function make(): self
    {
        return new static();
    }

    public function __construct(
        public array $migrations = [],
        public array $controllers = [],
        public array $models = [],
        public ?Route $route = null,
        public ?Config $config = null,
        public ?Resource $resource = null,
        public array $additionalSteps = [],
    ) {
    }

    public function handle(Publish $publish): void
    {
        foreach ($this->migrations as $migration) {
            $migration->handle($publish);
        }

        foreach ($this->controllers as $controller) {
            $controller->handle($publish);
        }

        foreach ($this->models as $model) {
            $model->handle($publish);
        }

        if ($this->route) {
            $this->route->handle($publish);
        }

        if ($this->config) {
            $this->config->handle($publish);
        }

        if ($this->resource) {
            $this->resource->handle($publish);
        }

        foreach ($this->additionalSteps as $additionalStep) {
            $additionalStep($publish);
        }
    }

    public function migrations(array $migrations): self
    {
        $this->migrations = $migrations;

        return $this;
    }

    public function controllers(array $controllers): self
    {
        $this->controllers = $controllers;

        return $this;
    }

    public function models(array $models): self
    {
        $this->models = $models;

        return $this;
    }

    public function routes(Route $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function config(Config $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function resources(Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function additionalSteps(array $additionalSteps): self
    {
        $this->additionalSteps = $additionalSteps;

        return $this;
    }
}
