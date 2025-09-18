<div>
    <table class="table">
        <thead>
            <tr>
                <th class="text-right">ID</th>
                <th class="text-left">name</th>
                <th class="text-left">email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->users as $user)
                <tr data-link="{{ HeliumCore::route('user.edit', $user->id) }}">
                    <td class="text-right">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $this->users->links() }}
</div>
