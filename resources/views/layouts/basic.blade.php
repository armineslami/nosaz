<!DOCTYPE html>
<html class="dark:dark" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')

    <script>
        const systemDarkModeListener = window.matchMedia('(prefers-color-scheme: dark)');
        systemDarkModeListener.addEventListener('change', function(e) {
            toggleTheme();
        });

        toggleTheme();

        function toggleTheme() {
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
                document.querySelector('meta[name="theme-color"]').setAttribute('content', '#121212');
            } else {
                document.documentElement.classList.remove('dark');
                document.querySelector('meta[name="theme-color"]').setAttribute('content', '#ededed');
            }
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-text-950 dark:text-text-50 antialiased bg-background">
    <div>
        {{ $slot }}
    </div>

    @include('components.update-app-prompt')
    @include('components.notification-permission-request-prompt')
</body>

</html>
