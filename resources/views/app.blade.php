<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        <link rel="stylesheet" src="{{ mix('css/app.css') }}" type="css">
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/theme.js') }}"></script>

        @env ('local')
            {{-- <script src="http://localhost:8080/js/bundle.js"></script> --}}
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
    </body>
</html>
