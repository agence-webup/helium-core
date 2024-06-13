@props([
    'title' => 'Helium',
    'css' => null,
    'cssStack' => null,
    'topbar' => null,
    'js' => null,
    'jsStack' => null,
])

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    @vite('resources/css/vendor/helium/app.css')
    {{ $css }}
    {{ $cssStack }}

    <title>{{ $title }}</title>
</head>

<body class="bg-[#F0F2F4] pb-10 text-base text-slate-800 antialiased">
    <main class="flex">
        <div class="fixed inset-y-0 left-0 w-64 overflow-auto border-r border-[#E1E6EA] bg-white pb-4 pt-5">
            <div class="flex flex-shrink-0 flex-grow flex-col px-3 pb-[70px]">
                <x-helium::layout.element.icon class="mb-5 w-10" />
                <x-helium::menu />
            </div>
            <div class="fixed bottom-0 w-64 border-r border-[#E1E6EA] bg-white">
                <x-helium::layout.element.profil />
            </div>
        </div>
        <div class="ml-[16rem] grow">
            {{ $topbar }}
            <div class="max-w mx-auto w-[90%] space-y-5 pt-10">
                {{ $slot }}
            </div>
        </div>
    </main>

    @vite('resources/js/vendor/helium/app.js')
    {{ $js }}
    {{ $jsStack }}
</body>

</html>
