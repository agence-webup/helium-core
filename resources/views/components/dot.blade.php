@props(['modifier' => 'red'])

@php
    $additionalClasses = '';
    switch ($modifier) {
        case 'gray':
            $additionalClasses = 'bg-gray-400';
            break;
        case 'red':
            $additionalClasses = 'bg-red-400';
            break;
        case 'yellow':
            $additionalClasses = 'bg-yellow-400';
            break;
        case 'green':
            $additionalClasses = 'bg-green-400';
            break;
        case 'blue':
            $additionalClasses = 'bg-blue-400';
            break;
        case 'indigo':
            $additionalClasses = 'bg-indigo-400';
            break;
        case 'purple':
            $additionalClasses = 'bg-purple-400';
            break;
        case 'pink':
            $additionalClasses = 'bg-pink-400';
            break;
        case 'orange':
            $additionalClasses = 'bg-orange-400';
            break;
    }
@endphp

<span {{ $attributes->merge(['class' => "{$additionalClasses} inline-flex rounded-full w-2.5 h-2.5"]) }}></span>
