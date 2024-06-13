@props(['title' => 'Log in on Helium'])

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    @vite('resources/css/vendor/helium/app.css')
</head>

<body class="flex min-h-screen items-center justify-center bg-slate-200">
    {{ $slot }}
    @vite('resources/js/vendor/helium/app.js')
</body>

</html>
