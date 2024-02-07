@props(['title', 'value'])

<div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-sm">
    <dt class="truncate text-sm font-medium text-gray-500">{{ $title }}</dt>
    <dd class="mt-1 text-2xl font-semibold tracking-tight text-gray-900">{{ $value }}</dd>
</div>
