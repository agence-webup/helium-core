@props(['name', 'label' => null])
<div>
    @isset($label)
        <label for="{{ $name }}" class="mb-1.5 block">{{ $label }}</label>
    @endisset
    <div>
        {{ $slot }}
    </div>

    @error($name . '*')
        <div class="mt-1 flex items-center text-red-600">
            <x-tabler-alert-triangle class="mr-0.5 h-5 w-5 text-red-500" aria-hidden="true" />
            <div>{{ $message }}</div>
        </div>
    @enderror
</div>
