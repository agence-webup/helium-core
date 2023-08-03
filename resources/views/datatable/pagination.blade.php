<div class="flex items-center justify-between border-[#E1E6EA] border-t p-5 mt-5">
    <span>Affichage <span class="font-medium">{{ $paginator->firstItem() }}</span> à <span
            class="font-medium">{{ $paginator->lastItem() }}</span> sur
        <span class="font-medium">{{ $paginator->total() }}</span> éléments</span>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                    aria-hidden="true" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <x-tabler-chevron-left class="w-4" />
                </a>
            @else
                <button type="button"
                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                    class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                    wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    rel="prev" aria-label="@lang('pagination.previous')">
                    <x-tabler-chevron-left class="w-4" />
                </button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true"
                        class="text-gray-700k relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                class="relative z-10 inline-flex items-center border border-sky-500 bg-sky-50 px-4 py-2 text-sm font-medium text-sky-600 focus:z-20">{{ $page }}</span>
                        @else
                            <button type="button"
                                class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">{{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button type="button"
                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                    class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                    wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    rel="next" aria-label="@lang('pagination.next')">
                    <x-tabler-chevron-right class="w-4" />
                </button>
            @else
                <span
                    class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                    aria-disabled="true" aria-label="@lang('pagination.next')" aria-hidden="true">
                    <x-tabler-chevron-right class="w-4" />
                </span>
            @endif
        </nav>
    @endif
</div>
