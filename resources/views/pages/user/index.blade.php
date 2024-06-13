<x-helium::layout.main title="Users">
    <x-helium::box title="Users">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-right">ID</th>
                    <th class="text-left">name</th>
                    <th class="text-left">email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr data-link="{{ route('helium::user.edit', $user->id) }}">
                        <td class="text-right">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-helium::box>
</x-helium::layout.main>
