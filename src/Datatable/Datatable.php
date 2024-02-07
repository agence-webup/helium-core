<?php

namespace Webup\HeliumCore\Datatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Datatable extends Component
{
    use WithPaginationAndSorting;

    public string $sharedKey;

    public string $queryPrefix = '';

    public string $search = '';

    public array $customFilters = [];

    public Model $model;

    public int $paginationSize = 100;

    protected $query;

    protected $data;

    protected $listeners = ['updateFromSidebar'];

    public array $clickableProperties = [
        'id',
    ];

    public function queryString()
    {
        return [
            'search' => ['except' => '', 'as' => $this->queryPrefix.'search'],
        ];
    }

    // ------------------ livewire lifecycle ------------------

    public function mount()
    {
        $this->customFilters = session()->get('datatable.'.$this->sharedKey, []);
        $this->model = $this->baseQuery()->getModel();
        $this->search = request()->get($this->queryPrefix.'search') ?? '';
    }

    public function render()
    {
        return view('hui::datatable.datatable');
    }

    public function updatingSearch()
    {
        $this->resetPage($this->getPageQueryName());
    }

    public function updatingPaginationSize()
    {
        $this->resetPage($this->getPageQueryName());
    }

    // ------------------ listeners ------------------

    public function updateFromSidebar()
    {
        $this->customFilters = session()->get('datatable.'.$this->sharedKey, []);
        $this->resetPage($this->getPageQueryName());
    }

    // ------------------ blade methods ------------------

    public function result()
    {
        if (! $this->data) {
            $this->data = $this->buildDatabaseQuery()->paginate($this->paginationSize, ['*'], $this->getPageQueryName());
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

    private function addSelect()
    {
        foreach ($this->columns() as $column) {
            if (! $column->isCustom) {
                if ($column->isRaw) {
                    $this->query->addSelect(DB::raw($column->rawSelect));
                } else {
                    $table = $this->model->getTable();
                    $alias = $table.'_'.$column->alias;
                    $this->query->addSelect(DB::raw("`$column->name` as `$alias`"));
                }
            }

        }
    }

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
        return 'hui::datatable.pagination';
    }

    // ------------------ helper methods ------------------

    private function getSearchableColumns()
    {
        return collect($this->columns())->filter(function ($column) {
            return $column->searchable;
        });
    }

    public function dispatchClick($model)
    {
        $this->onRowClick(json_decode($model));
    }

    public function formatModelForClickable($model)
    {
        $result = [];

        foreach ($this->clickableProperties as $property) {
            $result[$property] = $model->$property;
        }

        return json_encode($result);
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

    public function onRowClick($model)
    {
        // throw new \Exception("You must override the onRowClick method");
    }
}
