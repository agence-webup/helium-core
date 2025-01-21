<x-helium-core::layout.auth title="Log in">
    <form action="{{ Helium::route('postLogin') }}" method="post">
        @csrf
        <x-helium-core::box>
            <x-helium-core::form.input label="Email" type="email" name="email" required />

            <x-helium-core::form.input label="Password" type="password" name="password" required />
            <x-helium-core::button label="Login" class="mt-3 w-full" />
        </x-helium-core::box>
    </form>
</x-helium-core::layout.auth>
