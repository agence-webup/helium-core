@props(['url' => null, 'current' => false, 'sublevel' => null, 'icon' => null, 'opened' => false])

@php
    $cssCurrent = $current ? 'bg-gray-100' : '';
@endphp

@if ($sublevel === null)
    <a href="{{ $url }}" class="{{ $cssCurrent }} group flex w-full items-center rounded-md py-2 pl-2 text-sm font-medium">
        @if ($icon)
            @svg($icon, 'mr-3 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500')
        @endif
        {{ $slot }}
    </a>
@else
    <div x-data="{ open: @js($opened) }" class="space-y-1">
        <button type="button"
            class="ring-inse group flex w-full items-center rounded-md bg-white py-2 pl-2 pr-1 text-left text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            aria-controls="sub-menu-1" @click="open = !open" aria-expanded="true" x-bind:aria-expanded="open.toString()">
            @svg($icon, 'mr-3 h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500')
            <span class="flex-1">{{ $slot }}</span>
            <x-tabler-chevron-right class="ml-3 h-5 w-5 flex-shrink-0 rotate-90 transform text-gray-700 transition-colors duration-150 ease-in-out group-hover:text-gray-400" ::class="{ 'rotate-90': open, 'text-gray-300': !(open) }" x-state:on="Expanded"
                x-state:off="Collapsed" aria-hidden="true" />
        </button>
        <div class="space-y-1" id="sub-menu-1" x-show="open">
            {{ $sublevel }}
        </div>
    </div>
@endif
