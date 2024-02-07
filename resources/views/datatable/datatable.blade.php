<div>
    @if ($this->isSearchable())
        <div class="mb-8 flex items-center justify-between">
            <input wire:model="search"
                   type="search"
                   class="w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Recherche ...">
        </div>
    @endif

    {{-- @if ($this->hasActiveFilters())
        {{ $this->getActiveFiltersCount() }} Filtres actifs
    @endif

    <button x-data @click="$dispatch('open-sidebar', 'test')">
        Open Menu
    </button> --}}

    <table class="table">
        <thead>
            <tr>
                @foreach ($this->columns() as $column)
                    @if (!$column->hidden)
                        @include('hui::datatable.header', [
                            'label' => $column->label,
                            'class' => implode(' ', $column->headerClasses),
                            'sortable' => $column->sortable,
                        ])
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($this->result() as $result)
                <tr wire:click="dispatchClick('{{ $this->formatModelForClickable($result) }}')">
                    @foreach ($this->columns() as $column)
                        @if (!$column->hidden)
                            <td class="{{ implode(' ', $column->classes) }}">
                                {{ $column->render($result->getAttribute($column->alias), $result) }}
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $this->result()->links() }}

    {{-- {{ $this->getSideBar() }} --}}

</div>
