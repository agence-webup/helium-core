<?php

namespace Webup\HeliumCore\Datatable;

use Livewire\Component;

class Sidebar extends Component
{
    public string $sharedKey;

    public array $data = [];

    public function mount()
    {
        $this->data = session()->get('datatable.'.$this->sharedKey, []);
    }

    public function submitSidebar($data)
    {
        session()->put('datatable.'.$this->sharedKey, $data);
        $this->data = $data;
    }
}
