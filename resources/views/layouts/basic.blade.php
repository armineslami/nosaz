<!DOCTYPE html>
<html class="dark:dark" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        const systemDarkModeListener = window.matchMedia('(prefers-color-scheme: dark)');
        systemDarkModeListener.addEventListener('change', function(e) {
            toggleTheme();
        });

        toggleTheme();

        function toggleTheme() {
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    </script>
</head>

<body class="text-text-950 dark:text-text-50 antialiased bg-background">
    <div>
        {{ $slot }}
    </div>
</body>

</html>
