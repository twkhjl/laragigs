<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>

    @foreach ($listings as $key => $value)
        <h1>
            <a href="/listings/{{ $value['id'] }}">
                {{ $value['title'] }}
            </a>
        </h1>
        <p>{{ $value['description'] }}</p>
    @endforeach


</body>

</html>
