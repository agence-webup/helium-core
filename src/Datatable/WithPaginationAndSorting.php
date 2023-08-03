<?php

namespace Webup\LaravelHeliumCore\Datatable;

use Livewire\WithPagination;

trait WithPaginationAndSorting
{
    use WithPagination;

    public string $sortBy = '';

    public string $sortDirection = 'asc';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSqlOrder($this->sortDirection)
            : (new (get_called_class())())->sortDirection;

        $this->sortBy = $field;
        $this->resetPage();
    }

    private function reverseSqlOrder(string $order): string
    {
        return $order == 'asc' ? 'desc' : 'asc';
    }
}
