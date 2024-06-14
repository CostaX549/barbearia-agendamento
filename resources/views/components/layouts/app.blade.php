<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">

<link rel="manifest" href="{{ asset('/manifest.json') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    </head>



 
 <link rel="stylesheet" href="/build/assets/app-H3wy4wfz.css">
 
 @livewireStyles
    <wireui:scripts />


    <body>

        {{ $slot }}



        @livewireScriptConfig
        <script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AeWnrfIe0iqFrKZxVGGhbn9l9SwdgUAO90LJB-bP8i3ubeHdC7LzH2b7zjHeHSxODvp775m_-1cztzVQ&currency=BRL"></script>




    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js" defer></script>
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
