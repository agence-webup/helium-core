<div class="space-y-1">
    <x-helium::menu.item icon="tabler-users-group"
                         :opened="Route::is('helium::user.*')">
        Helium Users
        <x-slot:sublevel>
            <x-helium::menu.sub :url="route('helium::user.index')"
                                :current="Route::is('helium::user.*')">Users</x-helium::menu.sub>
            <x-helium::menu.sub url="#">Roles</x-helium::menu.sub>
        </x-slot:sublevel>
    </x-helium::menu.item>

    <x-helium::menu.item url="{{ route('helium::setting.index') }}"
                         icon="tabler-settings"
                         :current="Route::is('helium::setting.*')">Settings</x-helium::menu.item>
</div>
