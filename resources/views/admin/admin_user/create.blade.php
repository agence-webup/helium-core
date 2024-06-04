@extends('hui::layouts.admin')

@section('topbar')
    <x-hui::layout.topbar>
        <x-slot:title>Nouvel utilisateur</x-slot:title>
        <x-slot:actions>
            <x-hui::button href="#"
                           label="Primary"
                           icon="tabler-cloud-upload" />
            <x-hui::button href="#"
                           label="Secondary"
                           modifier="secondary"
                           icon="tabler-key" />
        </x-slot:actions>
    </x-hui::layout.topbar>
@endsection

@section('content')
    <x-hui::box>
        <x-slot:title>
            Informations
        </x-slot:title>

        @include('pages.{{ $resource }}.{{ $features->users->table_name }}.elements.form')
    </x-hui::box>
@endsection
