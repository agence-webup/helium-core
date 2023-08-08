@extends('helium-ui::layout.auth')

@section('content')
    <div class="rounded-md bg-white p-5 shadow">
        <form action="{{ route('{{ $routing.as }}login') }}"
              method="post">
            @csrf

            <x-helium-ui::form.input class="w-72"
                                     name="email"
                                     placeholder="email"
                                     type="text" />
            <x-helium-ui::form.input class="w-72"
                                     name="password"
                                     placeholder="Mot de passe"
                                     type="password" />

            <div class="mt-4">
                <button type="submit"
                        class="hover:bg-emerald-00 w-full rounded-md border border-transparent bg-emerald-600 px-3 py-3 text-sm font-medium leading-4 text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Se
                    connecter</button>
            </div>
        </form>
    </div>
@endsection
