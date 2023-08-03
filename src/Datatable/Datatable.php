<?php

namespace Webup\LaravelHeliumCore\Datatable;

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
    public int $paginationSize = 10;

    protected $query;
    protected $data;

    protected $listeners = ['updateFromSidebar'];

    // ------------------ livewire lifecycle ------------------

    public function mount()
    {
        $this->customFilters = session()->get("datatable." . $this->sharedKey, []);
        $this->model = $this->baseQuery()->getModel();
    }

    public function render()
    {
        return view('laravel-helium-core::datatable.datatable');
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
        $this->customFilters = session()->get("datatable." . $this->sharedKey, []);
        $this->resetPage();
    }

    // ------------------ blade methods ------------------

    public function result()
    {
        if (!$this->data) {
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
            return $filter !== null && $filter !== "";
        }));
    }

    public function getDataLinkAttr($model)
    {
        $result = null;

        if (method_exists($this, "link")) {
            $result = $this->link($model);
        }

        if ($result) {
            return 'data-link="' . $result . '"';
        }

        return "";
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
            if ($column->isRaw) {
                $this->query->addSelect(DB::raw($column->rawSelect));
            } elseif (str_contains($column->name, ".")) {
                throw new \Exception("Relationships not supported yet");
                // $relations = explode('.', Str::before($column->name, ':'));
                // $relationName = $relations[0];
                // $relationQuery = $this->query->getRelation($relationName);
                // if ($relationQuery instanceof HasMany || $relationQuery instanceof HasManyThrough || $relationQuery instanceof BelongsToMany) {
                //     $this->query->customWithAggregate($relationName, Str::after($column->name, ':') ?? 'count', $relations[1], $column->name);
                // } else {
                //     $this->addSelectWithRelation($column);
                //     // todo gérer les contraintes
                //     // cette ligne est fonctionne pour les HasOne avec contrainte mais le réquete n'est pas géniale
                //     // https://devblogs.microsoft.com/premier-developer/using-join-with-max-to-write-efficient-queries/
                //     // $this->query->custom($relationName, last($relations), $column->alias);
                // }
            } else {
                $table = $this->model->getTable();
                $col = $column->name;
                $alias = $column->alias;
                $this->query->addSelect(DB::raw("$table.$col as $alias"));
            }
        }
    }

    // private function addSelectWithRelation($column)
    // {
    //     $relations = explode('.', Str::before($column->name, ':'));
    //     $relatedQuery = $this->baseQuery();
    //     $table = null;

    //     $last = count($relations) - 1;
    //     foreach ($relations as $i => $relationName) {
    //         $isRelation = $i < $last;
    //         if ($isRelation) {
    //             $table = $relatedQuery->getRelation($relationName)->getRelated()->getTable();
    //             $useThrough = collect($this->query->getQuery()->joins)
    //                 ->pluck('table')
    //                 ->contains($table);

    //             $relatedQuery = $this->query->joinRelation($relationName, null, 'left', $useThrough, $relatedQuery);
    //         } else {
    //             $col = $relationName;
    //             $alias = $column->alias;
    //             $this->query->addSelect(DB::raw($table . '.' . $col . ' as `' . $alias . '`'));
    //         }
    //     }
    // }

    // todo gérer la recherche avec tous les type de relations
    private function addFilters()
    {
        $this->query->when($this->search, function ($query) {
            return $query->where(function ($subquery) {
                foreach (explode(" ", $this->search) as $key => $word) {
                    $subquery->where(function ($subsubquery) use ($word) {
                        foreach ($this->getSearchableColumns() as $key => $column) {
                            // if ($column->isRelation()) {
                            //     $relations = explode('.', Str::before($column->name, ':'));
                            //     $relationName = $relations[0];
                            //     $relationQuery = $this->query->getRelation($relationName);

                            //     if ($relationQuery instanceof HasOne || $relationQuery instanceof BelongsTo) {
                            //         $table = $this->query->getRelationTable($relationName);
                            //         $column = $relations[1];
                            //         return $subsubquery->whereRaw("`$table`.`$column` like '%" . $word . "%'");
                            //     } else {
                            //         return $subsubquery->whereRaw("$column->name like '%" . $word . "%'");
                            //     }
                            // }
                            return $subsubquery->whereRaw("$column->name like '%" . $word . "%'");
                        }
                    });
                }
            });
        });
    }

    private function addSort()
    {
        $alias = $this->sortBy;
        if (!$alias) {
            return;
        }

        $this->query->orderBy(DB::raw("`" . $alias . "`"), $this->sortDirection);
    }

    // ------------------ pagination methods ------------------

    public function paginationView()
    {
        return 'laravel-helium-core::datatable.pagination';
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
        throw new \Exception("You must override the baseQuery method");
    }

    public function link($model)
    {
        // throw new \Exception("You must override the link method");
    }

    public function columns()
    {
        throw new \Exception("You must override the columns method");
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
