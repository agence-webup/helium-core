<x-helium::layout.main title="Users">
    <x-slot:topbar>
        <x-helium::layout.element.topbar title="Users">
            <x-slot:actions>
                <x-helium::button :href="route('helium::user.create')"
                                  label="Create" />
            </x-slot:actions>
        </x-helium::layout.element.topbar>
    </x-slot:topbar>

    <x-helium::box>
        <livewire:helium::user-table />
    </x-helium::box>
</x-helium::layout.main>
