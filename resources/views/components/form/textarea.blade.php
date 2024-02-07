@props(['id', 'name', 'type' => 'text', 'label', 'value', 'info'])

@php
    $id = $id ?? $name;
    $value = $value ?? old($name);
    if ($errors->has($name)) {
        $additionalClasses = 'border-red-500';
    } else {
        $additionalClasses = 'border-gray-300';
    }
@endphp

<div>
    @isset($label)
        <label for="{{ $name }}" class="mb-1.5 block">{{ $label }}</label>
    @endisset

    <textarea {{ $attributes->merge(['class' => "{$additionalClasses} relative rounded-md shadow-sm border w-full"]) }}
        type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}">
    </textarea>
    @if (isset($info) && !$errors->has($name))
        <div class="mt-1.5 text-sm text-gray-500">{{ $info }}</div>
    @endif
    @error($name)
        <div class="mt-1 flex items-center text-red-600">
            <x-tabler-alert-triangle class="mr-0.5 h-5 w-5 text-red-500" aria-hidden="true" />
            <div>{{ $message }}</div>
        </div>
    @enderror
</div>
