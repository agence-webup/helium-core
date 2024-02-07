@props(['name', 'label', 'value', 'checked' => false, 'standalone'])

<label class="mt-3 flex cursor-pointer items-center">
    <input type="checkbox" name="{{ $name }}" @if ($checked || old($name) === 'on') checked @endif value="{{ $value }}">
    <span class="ml-2">{{ $label }}</span>
</label>

@isset($standalone)
    @error($name)
        <div class="mt-1 flex items-center text-red-600">
            <x-tabler-alert-triangle class="mr-0.5 h-5 w-5 text-red-500" aria-hidden="true" />
            <div>{{ $message }}</div>
        </div>
    @enderror
@endisset
