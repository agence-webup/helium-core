<x-helium::layout.auth title="Log in">
    <form action="{{ route('helium::postLogin') }}"
          method="post">
        @csrf
        <x-helium::box>
            <x-helium::form.input label="Email"
                                  type="email"
                                  name="email"
                                  required />

            <x-helium::form.input label="Password"
                                  type="password"
                                  name="password"
                                  required />
            <x-helium::button label="Login"
                              class="mt-3 w-full" />
        </x-helium::box>
    </form>
</x-helium::layout.auth>
