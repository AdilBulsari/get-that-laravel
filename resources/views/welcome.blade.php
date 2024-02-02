<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="/css/all.css" />
    <!-- Styles -->
    <script>
        (function() {
            window.laravel = {
                csrfToken: '{{ csrf_token()}}'
            }
        })()
    </script>
</head>

<body class="antialiased">
    <h1>This is the body </h1>
    <div id="app">
        <mainapp></mainapp>
        <router-view></router-view>
    </div>
</body>
<script src="{{ mix('/js/app.js') }}"></script>

</html>
