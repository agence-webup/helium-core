<?php

namespace Webup\HeliumCore\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class DatatableMakeCommand extends GeneratorCommand implements PromptsForMissingInput
{
    protected $signature = 'make:helium-datatable {name : The name of the datatable}';

    protected $description = 'Create a new bladeless livewire Datatable component';

    public function getStub()
    {
        return __DIR__.'/../../stubs/Datatable.php.stub';

    }

    protected function promptForMissingArgumentsUsing()
    {
        return [
            'name' => ['What should the datatable be named?', 'ex: UsersDatatable'],
        ];
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Livewire\Admin';
    }
}
