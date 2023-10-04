@props(['class' => '', 'label', 'sortable' => null])

<th @if ($sortable) wire:click="updateSortBy('{{ $sortable }}')" @endif
    @class([$class, 'cursor-pointer' => $sortable]) class="{{ $class }} p-3 text-sm font-semibold text-gray-900">
    <span class="inline-flex items-center">
        {{ $label }}
        @if ($sortable)
            @if ($this->sortBy == $sortable)
                @if ($this->sortDirection == 'asc')
                    <x-tabler-chevron-up class="ml-1 w-5" />
                @else
                    <x-tabler-chevron-down class="ml-1 w-5" />
                @endif
            @endif
        @endif
    </span>
</th>
