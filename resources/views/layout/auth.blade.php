<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Login on Helium</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    {{-- todo @val: this path won't work in a real environment --}}
    @vite('packages/helium-core/resources/css/app.css')
</head>

<body class="flex min-h-screen items-center justify-center bg-slate-200">
    @yield('content')
    {{-- todo @val: this path won't work in a real environment --}}
    @vite('packages/helium-core/resources/js/app.js')
</body>

</html>
