<div class="space-y-1">
    <x-helium-core::menu.item icon="tabler-users-group" :opened="HeliumCore::isRoute('user.*')">
        Helium Users
        <x-slot:sublevel>
            <x-helium-core::menu.sub :url="HeliumCore::route('user.index')" :current="HeliumCore::isRoute('user.*')">Users</x-helium-core::menu.sub>
            <x-helium-core::menu.sub url="#">Roles</x-helium-core::menu.sub>
        </x-slot:sublevel>
    </x-helium-core::menu.item>

    <x-helium-core::menu.item url="{{ HeliumCore::route('setting.index') }}" icon="tabler-settings" :current="HeliumCore::isRoute('setting.*')">Settings</x-helium-core::menu.item>
</div>
