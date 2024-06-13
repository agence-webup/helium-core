<x-hui::layout.auth title="Log in">
    <form action="{{ route('helium::postLogin') }}"
          method="post">
        @csrf
        <x-hui::box>
            <x-hui::form.input label="Email"
                               type="email"
                               name="email"
                               required />

            <x-hui::form.input label="Password"
                               type="password"
                               name="password"
                               required />
            <x-hui::button label="Login"
                           class="mt-3 w-full" />
        </x-hui::box>
    </form>
</x-hui::layout.auth>
