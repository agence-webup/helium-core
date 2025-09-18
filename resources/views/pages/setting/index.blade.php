<x-helium-core::layout.main title="Settings">
    <x-slot:topbar>
        <x-helium-core::layout.element.topbar title="Settings" />
    </x-slot:topbar>
    <x-helium-core::box>
        <table class="table">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Last updated at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($settings as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-helium-core::box>
</x-helium-core::layout.main>
