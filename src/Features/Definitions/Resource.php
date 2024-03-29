<?php

namespace Webup\HeliumCore\Features\Definitions;

use Webup\HeliumCore\Commands\Publish;

class Resource extends Step
{
    public string $directory;

    public function handle(Publish $command): void
    {
        if (is_dir(__DIR__.'/../../../resources/views/pages/'.$this->stub)) {
            $command->comment('Publishing pages...');
            foreach ($command->getAllFiles(__DIR__.'/../../../resources/views/pages/'.$this->stub) as $filename => $filepath) {
                $command->comment("- $filename");
                $content = file_get_contents($filepath);
                if ($this->stub_processor !== null) {
                    $content = ($this->stub_processor)($content);
                }
                $command->publish(
                    $content,
                    base_path('resources/views/pages/'.config('helium-core.resources').'/'.$this->directory.'/'.basename($filename))
                );
            }
        }

        // same for components, livewire, js, css
        if (is_dir(__DIR__.'/../../../resources/views/components/'.$this->stub)) {
            $command->comment('Publishing components...');
            foreach ($command->getAllFiles(__DIR__.'/../../../resources/views/components/'.$this->stub) as $filename => $filepath) {
                $command->comment("- $filename");
                $content = file_get_contents($filepath);
                if ($this->stub_processor !== null) {
                    $content = ($this->stub_processor)($content);
                }
                $command->publish(
                    $content,
                    base_path('resources/views/components/'.config('helium-core.resources').'/'.$this->directory.'/'.$filename)
                );
            }
        }

        if (is_dir(__DIR__.'/../../../resources/views/livewire/'.$this->stub)) {
            $command->comment('Publishing livewire...');
            foreach ($command->getAllFiles(__DIR__.'/../../../resources/views/livewire/'.$this->stub) as $filename => $filepath) {
                $command->comment("- $filename");
                $content = file_get_contents($filepath);
                if ($this->stub_processor !== null) {
                    $content = ($this->stub_processor)($content);
                }
                $command->publish(
                    $content,
                    base_path('resources/views/livewire/'.config('helium-core.resources').'/'.$this->directory.'/'.$filename)
                );
            }
        }

        if (is_dir(__DIR__.'/../../../resources/js/'.$this->stub)) {
            $command->comment('Publishing js...');
            foreach ($command->getAllFiles(__DIR__.'/../../../resources/js/'.$this->stub) as $filename => $filepath) {
                $command->comment("- $filename");
                $content = file_get_contents($filepath);
                if ($this->stub_processor !== null) {
                    $content = ($this->stub_processor)($content);
                }
                $command->publish(
                    $content,
                    base_path('resources/js/'.config('helium-core.resources').'/'.$this->directory.'/'.$filename)
                );
            }
        }

        if (is_dir(__DIR__.'/../../../resources/css/'.$this->stub)) {
            $command->comment('Publishing css...');
            foreach ($command->getAllFiles(__DIR__.'/../../../resources/css/'.$this->stub) as $filename => $filepath) {
                $command->comment("- $filename");
                $content = file_get_contents($filepath);
                if ($this->stub_processor !== null) {
                    $content = ($this->stub_processor)($content);
                }
                $command->publish(
                    $content,
                    base_path('resources/css/'.config('helium-core.resources').'/'.$this->directory.'/'.$filename)
                );
            }
        }
    }

    public function directory(string $directory): self
    {
        $this->directory = $directory;

        return $this;
    }
}
