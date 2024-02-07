@props(['label', 'href'])

@isset($href)
    <a href="#" class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-gray-50 disabled:text-gray-500">
        {{ $label }}
    </a>
@else
    <button class="flex w-full items-center gap-2 px-4 py-2.5 text-left text-sm first-of-type:rounded-t-md last-of-type:rounded-b-md hover:bg-gray-50 disabled:text-gray-500">
        {{ $label }}
    </button>
@endisset
