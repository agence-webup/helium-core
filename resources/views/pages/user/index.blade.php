<x-helium-core::layout.main title="Users">
    <x-slot:topbar>
        <x-helium-core::layout.element.topbar title="Users">
            <x-slot:actions>
                <x-helium-core::button :href="Helium::route('user.create')" label="Create" />
            </x-slot:actions>
        </x-helium-core::layout.element.topbar>
    </x-slot:topbar>

    <x-helium-core::box>
        <livewire:helium-core::user-table />
    </x-helium-core::box>
</x-helium-core::layout.main>
