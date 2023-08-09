<?php

namespace Webup\HeliumCore\Datatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Datatable extends Component
{
    use WithPaginationAndSorting;

    public string $sharedKey;

    public string $search = '';

    public array $customFilters = [];

    public Model $model;

    public int $paginationSize = 100;

    protected $query;

    protected $data;

    protected $listeners = ['updateFromSidebar'];

    // ------------------ livewire lifecycle ------------------

    public function mount()
    {
        $this->customFilters = session()->get('datatable.'.$this->sharedKey, []);
        $this->model = $this->baseQuery()->getModel();
    }

    public function render()
    {
        return view('helium-core::datatable.datatable');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPaginationSize()
    {
        $this->resetPage();
    }

    // ------------------ listeners ------------------

    public function updateFromSidebar()
    {
        $this->customFilters = session()->get('datatable.'.$this->sharedKey, []);
        $this->resetPage();
    }

    // ------------------ blade methods ------------------

    public function result()
    {
        if (! $this->data) {
            $this->data = $this->buildDatabaseQuery()->paginate($this->paginationSize);
        }

        return $this->data;
    }

    public function isSearchable()
    {
        return count($this->getSearchableColumns()) > 0;
    }

    public function getActiveFiltersCount()
    {
        return count(collect($this->customFilters)->filter(function ($filter) {
            return $filter !== null && $filter !== '';
        }));
    }

    public function getDataLinkAttr($model)
    {
        $result = null;

        if (method_exists($this, 'link')) {
            $result = $this->link($model);
        }

        if ($result) {
            return 'data-link="'.$result.'"';
        }

        return '';
    }

    public function hasActiveFilters()
    {
        return $this->getActiveFiltersCount() > 0;
    }

    // ------------------ query builder ------------------

    private function buildDatabaseQuery()
    {
        $this->query = $this->baseQuery();
        $this->addSelect();
        $this->addFilters();
        $this->addCustomFilters($this->customFilters);
        $this->addSort();

        return $this->query;
    }

    // todo gérer les nested relation
    private function addSelect()
    {
        $this->query->addSelect($this->model->getKeyName());

        foreach ($this->columns() as $column) {
            if (! $column->isCustom) {
                if ($column->isRaw) {
                    $this->query->addSelect(DB::raw($column->rawSelect));
                } else {
                    $table = $this->model->getTable();
                    $col = $column->name;
                    $alias = $column->alias;
                    $this->query->addSelect(DB::raw("$table.$col as $alias"));
                }
            }

        }
    }

    // todo gérer la recherche avec tous les type de relations
    private function addFilters()
    {
        $this->query->when($this->search, function ($query) {
            return $query->where(function ($subquery) {
                foreach (explode(' ', $this->search) as $key => $word) {
                    $subquery->where(function ($subsubquery) use ($word) {
                        foreach ($this->getSearchableColumns() as $key => $column) {
                            $subsubquery->orWhereRaw("$column->name like '%".$word."%'");
                        }
                    });
                }
            });
        });
    }

    private function addSort()
    {
        $alias = $this->sortBy;
        if (! $alias) {
            return;
        }

        $this->query->orderBy(DB::raw('`'.$alias.'`'), $this->sortDirection);
    }

    // ------------------ pagination methods ------------------

    public function paginationView()
    {
        return 'helium-core::datatable.pagination';
    }

    // ------------------ helper methods ------------------

    private function getSearchableColumns()
    {
        return collect($this->columns())->filter(function ($column) {
            return $column->searchable;
        });
    }

    // ------------------ methods to override ------------------

    public function baseQuery()
    {
        throw new \Exception('You must override the baseQuery method');
    }

    public function link($model)
    {
        // throw new \Exception("You must override the link method");
    }

    public function columns()
    {
        throw new \Exception('You must override the columns method');
    }

    public function addCustomFilters($customFilters)
    {
        // throw new \Exception("You must override the addCustomFilters method");
    }

    public function getSideBar()
    {
        // throw new \Exception("You must override the getSideBar method");
    }
}
