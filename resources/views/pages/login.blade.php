<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <form action="{{ route('helium::login') }}" method="post">
        @csrf
        <input type="text" name="email">
        <input type="password" name="password">
        <button type="submit">Log in</button>
    </form>
</body>

</html>
