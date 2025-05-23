<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BarberConnect</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="{{ asset('barbearia.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('barbearia.png') }}">


        <link rel="manifest" href="{{ asset('/manifest.json') }}">
        <!-- Scripts -->
      <link rel="stylesheet" href="/build/assets/app-H3wy4wfz.css">

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScriptConfig

        <script src="{{ asset('/sw.js') }}">

        </script>

        <script src="/build/assets/app-v3VqPkE0.js " defer></script>

        <script>

        if (!navigator.serviceWorker.controller) {

        navigator.serviceWorker.register("/sw.js").

        then(function (reg) {

        console.log("Service worker has been registered for scope: " + reg.scope);

        });

        }

        </script>
    </body>


</html>
