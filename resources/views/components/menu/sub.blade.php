@props(['url' => null, 'current' => false])

@php
    $opened = false;
    $cssCurrent = $current ? 'bg-gray-100' : '';
@endphp

<a href="{{ $url }}" class="{{ $cssCurrent }} group flex w-full items-center rounded-md py-2 pl-11 text-sm font-medium">
    {{ $slot }}
</a>
