@extends('helium-ui::layouts.admin')

@section('topbar')
    <x-helium-ui::layout.topbar>
        <x-slot:title>Nouvel utilisateur</x-slot:title>
        <x-slot:actions>
            <x-helium-ui::button href="#"
                                 label="Primary"
                                 icon="tabler-cloud-upload" />
            <x-helium-ui::button href="#"
                                 label="Secondary"
                                 modifier="secondary"
                                 icon="tabler-key" />
        </x-slot:actions>
    </x-helium-ui::layout.topbar>
@endsection

@section('content')
    <x-helium-ui::box>
        <x-slot:title>
            Informations
        </x-slot:title>

        @include('pages.{{ $resource }}.{{ $features . users . table_name }}.elements.form')
    </x-helium-ui::box>
@endsection
