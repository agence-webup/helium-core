<div class="space-y-1">
    <x-helium-core::menu.item icon="tabler-users-group" :opened="Helium::isRoute('user.*')">
        Helium Users
        <x-slot:sublevel>
            <x-helium-core::menu.sub :url="Helium::route('user.index')" :current="Helium::isRoute('user.*')">Users</x-helium-core::menu.sub>
            <x-helium-core::menu.sub url="#">Roles</x-helium-core::menu.sub>
        </x-slot:sublevel>
    </x-helium-core::menu.item>

    <x-helium-core::menu.item url="{{ Helium::route('setting.index') }}" icon="tabler-settings" :current="Helium::isRoute('setting.*')">Settings</x-helium-core::menu.item>
</div>
