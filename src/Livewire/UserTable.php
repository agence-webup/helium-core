<?php

namespace Webup\Helium\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Webup\Helium\Models\User;

class UserTable extends Component
{
    use WithPagination;

    public function getUsersProperty()
    {
        return User::paginate(10);
    }

    public function render()
    {
        return view('helium-core::livewire.user-table');
    }
}
