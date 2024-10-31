<!DOCTYPE html>
<html class="dark:dark" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')

    <script>
        const key = 'theme-{{ Auth::user()->email }}';

        // Applies the app theme
        function applyTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                localStorage.setItem(key, 'dark'); // Save user preference
                document.querySelector('meta[name="theme-color"]').setAttribute('content', '#121212');
            } else if (theme === 'light') {
                document.documentElement.classList.remove('dark');
                localStorage.setItem(key, 'light'); // Save user preference
                document.querySelector('meta[name="theme-color"]').setAttribute('content', '#ededed');
            } else {
                // Handle system theme preference
                localStorage.setItem(key, 'system');
                if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.classList.add('dark');
                    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#121212');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.querySelector('meta[name="theme-color"]').setAttribute('content', '#ededed');
                }
            }
        }

        // Immediately check the user's stored theme or system preference
        (function() {
            // The settings are provided with AppServiceProvider
            const theme = '{{ $settings->app_theme }}'; // localStorage.getItem(key) || 'system';
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

            <main class="p-2 pt-24 pb-24 md:p-4 md:pt-24">
                {{ $slot }}
            </main>

            @include('layouts.bottom-navigation')
        </div>

        <!-- Social modal -->
        @include('layouts.social-modal')

    </div>
</body>

</html>
