<div class="space-y-1">

    <x-helium::menu.item url="#"
                         icon="tabler-users-group"
                         :opened="true">
        Users
        <x-slot:sublevel>
            <x-helium::menu.sub :url="route('helium::user.index')">Users</x-helium::menu.sub>
            <x-helium::menu.sub url="#">Roles</x-helium::menu.sub>
        </x-slot:sublevel>
    </x-helium::menu.item>

    <x-helium::menu.item url="#"
                         icon="tabler-settings">Settings</x-helium::menu.item>
</div>
