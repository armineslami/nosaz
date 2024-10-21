<!DOCTYPE html>
<html class="dark:dark" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-background">

        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        @include('layouts.drawer')

        <!-- Page Content -->
        <div class="relative md:ms-64 h-auto">

            @include('layouts.navigation')

            <main class="p-2 pt-24 pb-20 md:p-4 md:pt-24">
                {{ $slot }}
            </main>

            @include('layouts.bottom-navigation')
        </div>

        <!-- Social modal -->
        @include('layouts.social-modal')

    </div>

    <script>
        // Applies the app theme
        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark'); // Save user preference
            } else if (theme === 'light') {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light'); // Save user preference
            } else {
                // Handle system theme preference
                localStorage.setItem('theme', 'system');
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }

        // Immediately check the user's stored theme or system preference
        (function() {
            const theme = localStorage.getItem('theme') || 'system';
            applyTheme(theme);

            // If the theme is set to 'system', listen for system theme changes
            const systemDarkModeListener = window.matchMedia('(prefers-color-scheme: dark)');

            if (theme === 'system') {
                systemDarkModeListener.addEventListener('change', function(e) {
                    applyTheme('system'); // Only change theme if the user selected "system"
                });
            }

            // Clean up listener on page unload
            window.addEventListener('beforeunload', function() {
                systemDarkModeListener.removeEventListener('change', function() {
                    applyTheme('system');
                });
            });
        })();
    </script>
</body>

</html>
