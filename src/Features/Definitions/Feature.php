<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Closure;
use Webup\LaravelHeliumCore\Commands\Publish;

class Feature
{
    private ?Closure $default_stub_processor = null;

    public static function make(): self
    {
        return new static();
    }

    public function __construct(
        public array $migrations = [],
        public array $controllers = [],
        public array $models = [],
        public ?Route $route = null,
        public ?Resource $resource = null,
        public array $prologue = [],
        public array $epilogue = [],
    ) {
    }

    public function handle(Publish $publish): void
    {
        foreach ($this->prologue as $step) {
            $step($publish);
        }

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

        if ($this->resource) {
            $this->resource->handle($publish);
        }

        foreach ($this->epilogue as $step) {
            $step($publish);
        }
    }

    public function migrations(array $migrations): self
    {
        $this->migrations = $migrations;

        foreach ($this->migrations as $migration) {
            if ($migration->stub_processor === null) {
                $migration->stub_processor = $this->default_stub_processor;
            }
        }

        return $this;
    }

    public function controllers(array $controllers): self
    {
        $this->controllers = $controllers;

        foreach ($this->controllers as $controller) {
            if ($controller->stub_processor === null) {
                $controller->stub_processor = $this->default_stub_processor;
            }
        }

        return $this;
    }

    public function models(array $models): self
    {
        $this->models = $models;

        foreach ($this->models as $model) {
            if ($model->stub_processor === null) {
                $model->stub_processor = $this->default_stub_processor;
            }
        }

        return $this;
    }

    public function routes(Route $route): self
    {
        $this->route = $route;
        if ($this->route->stub_processor === null) {
            $this->route->stub_processor = $this->default_stub_processor;
        }

        return $this;
    }

    public function resources(Resource $resource): self
    {
        $this->resource = $resource;

        if ($this->resource->stub_processor === null) {
            $this->resource->stub_processor = $this->default_stub_processor;
        }

        return $this;
    }

    public function prologue(array $steps): self
    {
        $this->prologue = $steps;

        return $this;
    }

    public function epilogue(array $steps): self
    {
        $this->epilogue = $steps;

        return $this;
    }

    public function default_stub_processor(Closure $processor): self
    {
        $this->default_stub_processor = $processor;

        return $this;
    }
}
