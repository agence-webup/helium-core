<?php

namespace Webup\HeliumCore\Datatable;

use Closure;
use Illuminate\Support\Str;

class Column
{
    /**
     * @var string|null Raw SQL select statement.
     */
    public ?string $rawSelect = null;

    /**
     * @var bool Whether the column is a raw SQL select statement.
     */
    public bool $isRaw = false;

    /**
     * @var bool Whether the column is a custom column.
     */
    public bool $isCustom = false;

    /**
     * @var string Name of the column.
     */
    public string $name;

    /**
     * @var string Alias of the column.
     */
    public string $alias;

    /**
     * @var Closure|null Formatter function for the column.
     */
    public ?Closure $formatter = null;

    /**
     * @var string Label for the column.
     */
    public string $label = '';

    /**
     * @var array Classes for the column.
     */
    public array $classes = [];

    /**
     * @var array Header classes for the column.
     */
    public array $headerClasses = [];

    /**
     * @var string|null Whether the column is sortable.
     */
    public ?string $sortable = null;

    /**
     * @var bool Whether the column is searchable.
     */
    public bool $searchable = false;

    /**
     * @var bool Whether the column is hidden.
     */
    public bool $hidden = false;

    /**
     * Create a column that represents a raw SQL select statement.
     *
     * @param  string  $name The raw SQL select statement.
     */
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

    /**
     * Create a column that represents a regular SQL select statement.
     *
     * @param  string  $name The name of the column.
     */
    public static function select(string $name): self
    {
        $column = new self();
        $column->name = $name;
        $column->rawSelect = $name;
        $column->alias = $name;

        if (count($exploded = explode(' as ', Str::lower($name))) == 2) {
            $column->name = $exploded[0];
            $column->alias = $exploded[0].$exploded[1];
        }
        $column->label = ucfirst($column->name);

        return $column;
    }

    /**
     * Create a column that represents a column that is not part of the SQL select statement, but is added to the data table.
     *
     * @param  string  $name The name of the column.
     */
    public static function add(string $name): self
    {
        $column = new self();
        $column->name = $name;
        $column->isCustom = true;
        $column->rawSelect = $name;
        $column->alias = $name;
        $column->label = ucfirst($column->name);

        return $column;
    }

    /**
     * Set the formatter function for the column.
     *
     * @param  Closure  $formatter The formatter function.
     */
    public function formatter(Closure $formatter): self
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * Set the label for the column.
     *
     * @param  string  $label The label for the column.
     */
    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the classes for the column.
     *
     * @param  string|array  $classes The classes for the column.
     */
    public function classes(string|array $classes): self
    {
        if (is_string($classes)) {
            $classes = explode(' ', $classes);
        }
        $this->classes = $classes;

        return $this;
    }

    /**
     * Set the header classes for the column.
     *
     * @param  string|array  $headerClasses The header classes for the column.
     */
    public function headerClasses(string|array $headerClasses): self
    {
        if (is_string($headerClasses)) {
            $headerClasses = explode(' ', $headerClasses);
        }
        $this->headerClasses = $headerClasses;

        return $this;
    }

    /**
     * Set the classes for both the column and the header.
     *
     * @param  string|array  $classes The classes for the column and header.
     */
    public function columnClasses(string|array $classes): self
    {
        if (is_string($classes)) {
            $classes = explode(' ', $classes);
        }

        $this->classes = $classes;
        $this->headerClasses = $classes;

        return $this;
    }

    /**
     * Align the column to the right.
     */
    public function alignRight(): self
    {
        $this->classes[] = 'text-right';
        $this->headerClasses[] = 'text-right';

        return $this;
    }

    /**
     * Align the column to the center.
     */
    public function alignCenter(): self
    {
        $this->classes[] = 'text-center';
        $this->headerClasses[] = 'text-center';

        return $this;
    }

    /**
     * Align the column to the left.
     */
    public function alignLeft(): self
    {
        $this->classes[] = 'text-left';
        $this->headerClasses[] = 'text-left';

        return $this;
    }

    /**
     * Set the sortable property for the column.
     *
     * @param  string|null  $sortable The sortable property for the column.
     */
    public function sortable(string $sortable = null): self
    {
        if ($sortable === null) {
            $this->sortable = $this->alias;
        } else {
            $this->sortable = $sortable;
        }

        return $this;
    }

    /**
     * Set the searchable property for the column.
     *
     * @param  bool  $searchable The searchable property for the column.
     */
    public function searchable(bool $searchable = true): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * Set the hidden property for the column.
     *
     * @param  bool  $hidden The hidden property for the column.
     */
    public function hidden(bool $hidden = true): self
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Set the formatter function for the column.
     *
     * @param  Closure  $formatter The formatter function.
     */
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
