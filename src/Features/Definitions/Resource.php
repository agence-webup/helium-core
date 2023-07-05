<?php

namespace Webup\LaravelHeliumCore\Features\Definitions;

use Webup\LaravelHeliumCore\Commands\Publish;

class Resource extends Step
{
    public string $pages = '';

    public string $components = '';

    public string $livewire = '';

    public string $js = '';

    public string $css = '';

    public function handle(Publish $command): void
    {
        if (is_dir(__DIR__ . '/../../../resources/views/pages/' . $this->pages)) {
            $command->comment('Publishing pages...');
            $command->publish(
                __DIR__ . '/../../../resources/views/pages/' . $this->pages,
                base_path('resources/views/pages/helium/' . $this->pages)
            );
        }

        if (is_dir(__DIR__ . '/../../../resources/views/components/' . $this->components)) {
            $command->comment('Publishing components...');
            $command->publish(
                __DIR__ . '/../../../resources/views/components/' . $this->components,
                base_path('resources/views/components/helium/' . $this->components)
            );
        }

        if (is_dir(__DIR__ . '/../../../resources/views/livewire/' . $this->livewire)) {
            $command->comment('Publishing livewire...');
            $command->publish(
                __DIR__ . '/../../../resources/views/livewire/' . $this->livewire,
                base_path('resources/views/livewire/helium/' . $this->livewire)
            );
        }

        if (is_dir(__DIR__ . '/../../../resources/js/' . $this->js)) {
            $command->comment('Publishing js...');
            $command->publish(
                __DIR__ . '/../../../resources/js/' . $this->js,
                base_path('resources/js/helium/' . $this->js)
            );
        }

        if (is_dir(__DIR__ . '/../../../resources/css/' . $this->css)) {
            $command->comment('Publishing css...');
            $command->publish(
                __DIR__ . '/../../../resources/css/' . $this->css,
                base_path('resources/css/helium/' . $this->css)
            );
        }
    }

    public function pages(string $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    public function components(string $components): self
    {
        $this->components = $components;

        return $this;
    }

    public function livewire(string $livewire): self
    {
        $this->livewire = $livewire;

        return $this;
    }

    public function js(string $js): self
    {
        $this->js = $js;

        return $this;
    }

    public function css(string $css): self
    {
        $this->css = $css;

        return $this;
    }
}
