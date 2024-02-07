@props(['label', 'filter'])

<button @isset($filter) data-helium-filter="{{ $filter }}" @endisset
    class="inline-block rounded border bg-white px-3 py-2 text-sm font-medium hover:scale-105">
    {{ $label }}
</button>
