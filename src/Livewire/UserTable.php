<?php

namespace Webup\Helium\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Webup\Helium\Facades\HeliumCore;

class UserTable extends Component
{
    use WithPagination;

    public function getUsersProperty()
    {
        $class = HeliumCore::userClass();

        return $class::paginate(10);
    }

    public function render()
    {
        return view('helium-core::livewire.user-table');
    }
}
