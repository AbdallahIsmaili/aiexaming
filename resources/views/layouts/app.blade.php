<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            // function autoRefresh() {
            //     var currentUrl = window.location.href;
            //     $('#content').load(currentUrl + ' #refresh-content > *', function() {
            //         // Callback function after content is reloaded
            //     });
            // }

            // $(document).ready(function() {
            //     setInterval(autoRefresh, 1000); // Refresh every 1 second (adjust the interval as needed)
            // });
        </script>

        <style>
            .toast {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #00be5c;
                color: #fff;
                padding: 12px 24px;
                border-radius: 4px;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
                z-index: 999;
            }

            .show-toast {
                opacity: 1;
            }
            
        </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div id="refresh-content">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </body>
</html>
