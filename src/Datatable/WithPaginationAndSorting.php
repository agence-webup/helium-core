<?php

namespace Webup\HeliumCore\Datatable;

use Livewire\WithPagination;

trait WithPaginationAndSorting
{
    use WithPagination;

    public string $sortBy = '';

    public string $sortDirection = 'asc';

    public function mountWithPaginationAndSorting()
    {
        $this->sortBy = request()->get($this->queryPrefix.'sort') ?? '';
        $this->sortDirection = request()->get($this->queryPrefix.'sortd', $this->sortDirection) ?? '';
    }

    public function queryStringWithPaginationAndSorting()
    {
        return [
            'sortBy' => ['except' => 'name', 'as' => $this->queryPrefix.'sort'],
            'sortDirection' => ['except' => 'asc', 'as' => $this->queryPrefix.'sortd'],
        ];
    }

    public function updateSortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSqlOrder($this->sortDirection)
            : (new (get_called_class())())->sortDirection;
        $this->sortBy = $field;
        $this->resetPage($this->getPageQueryName());
    }

    private function reverseSqlOrder(string $order): string
    {
        return $order == 'asc' ? 'desc' : 'asc';
    }
}
