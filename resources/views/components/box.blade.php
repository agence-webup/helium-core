<div class="overflow-hidden rounded-lg bg-white shadow-sm">
    @isset($title)
        <div class="flex items-center justify-between border-b border-[#E1E6EA] px-5 py-4 text-lg font-medium leading-none">
            <h2>{{ $title }}</h2>
        </div>
    @endisset
    <div class="p-5">
        {{ $slot }}
    </div>
</div>
