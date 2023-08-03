<?php

namespace Webup\LaravelHeliumCore\Datatable;

use Closure;
use Illuminate\Support\Str;

class Column
{
    public ?string $rawSelect = null;

    public bool $isRaw = false;

    public string $name;

    public string $alias;

    public ?Closure $formatter = null;

    public string $label = '';

    public array $classes = [];

    public array $headerClasses = [];

    public bool $sortable = false;

    public bool $searchable = false;

    public bool $hidden = false;

    public static function raw(string $name): self
    {
        $column = new self();
        $exploded = explode(' as ', Str::lower($name));
        $column->isRaw = true;
        $column->name = $exploded[0];
        $column->alias = $exploded[1];
        $column->rawSelect = $name;
        $column->label = ucfirst($column->name);

        return $column;
    }

    public static function name(string $name): self
    {
        $column = new self();
        $column->name = $name;
        $column->rawSelect = $name;
        $column->alias = $name;

        if (count($exploded = explode(' as ', Str::lower($name))) == 2) {
            $column->name = $exploded[0];
            $column->alias = $exploded[1];
        }
        $column->label = ucfirst($column->name);

        return $column;
    }

    public function headerClasses(string|array $headerClasses): self
    {
        if (is_string($headerClasses)) {
            $headerClasses = explode(' ', $headerClasses);
        }
        $this->headerClasses = $headerClasses;

        return $this;
    }

    public function classes(string|array $classes): self
    {
        if (is_string($classes)) {
            $classes = explode(' ', $classes);
        }
        $this->classes = $classes;

        return $this;
    }

    public function alignRight(): self
    {
        $this->classes[] = 'text-right';
        $this->headerClasses[] = 'text-right';

        return $this;
    }

    public function alignCenter(): self
    {
        $this->classes[] = 'text-center';
        $this->headerClasses[] = 'text-center';

        return $this;
    }

    public function alignLeft(): self
    {
        $this->classes[] = 'text-left';
        $this->headerClasses[] = 'text-left';

        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function sortable(bool $sortable = true): self
    {
        $this->sortable = $sortable;

        return $this;
    }

    public function searchable(bool $searchable = true): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function hidden(bool $hidden = true): self
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function format(Closure $formatter): self
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * @retrun string | \Illuminate\Contracts\Support\Htmlable
     */
    public function render($value, $obj)
    {
        if ($this->formatter) {
            $func = $this->formatter;

            return $func($value, $obj);
        }

        return $value;
    }

    public function isRelation()
    {
        return str_contains($this->name, '.');
    }
}
