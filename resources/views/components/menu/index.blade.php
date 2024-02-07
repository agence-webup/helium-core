<div class="space-y-1">
    <x-hui::menu.item url="#"
                      icon="tabler-air-balloon">Menu 1</x-hui::menu.item>
    <x-hui::menu.item url="#"
                      icon="tabler-artboard"
                      :opened="true">
        Menu 2
        <x-slot:sublevel>
            <x-hui::menu.sub url="#">Menu 2.1</x-hui::menu.sub>
            <x-hui::menu.sub url="#">Menu 2.2</x-hui::menu.sub>
            <x-hui::menu.sub url="#">Menu 2.3</x-hui::menu.sub>
        </x-slot:sublevel>
    </x-hui::menu.item>
    <x-hui::menu.item url="#"
                      icon="tabler-shopping-cart"
                      current>Menu 3</x-hui::menu.item>
    <x-hui::menu.item url="#"
                      icon="tabler-chart-pie">Menu 4</x-hui::menu.item>
    <x-hui::menu.item url="#"
                      icon="tabler-cactus">Menu 5</x-hui::menu.item>
    <x-hui::menu.item url="#"
                      icon="tabler-settings">Menu 6</x-hui::menu.item>
</div>
