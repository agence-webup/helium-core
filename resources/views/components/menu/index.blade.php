<div class="space-y-1">
    <x-helium::menu.item url="#"
                         icon="tabler-air-balloon">Menu 1</x-helium::menu.item>
    <x-helium::menu.item url="#"
                         icon="tabler-artboard"
                         :opened="true">
        Menu 2
        <x-slot:sublevel>
            <x-helium::menu.sub url="#">Menu 2.1</x-helium::menu.sub>
            <x-helium::menu.sub url="#">Menu 2.2</x-helium::menu.sub>
            <x-helium::menu.sub url="#">Menu 2.3</x-helium::menu.sub>
        </x-slot:sublevel>
    </x-helium::menu.item>
    <x-helium::menu.item url="#"
                         icon="tabler-shopping-cart"
                         current>Menu 3</x-helium::menu.item>
    <x-helium::menu.item url="#"
                         icon="tabler-chart-pie">Menu 4</x-helium::menu.item>
    <x-helium::menu.item url="#"
                         icon="tabler-cactus">Menu 5</x-helium::menu.item>
    <x-helium::menu.item url="#"
                         icon="tabler-settings">Menu 6</x-helium::menu.item>
</div>
