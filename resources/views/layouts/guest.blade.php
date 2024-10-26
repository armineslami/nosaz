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
    <div class="flex min-h-screen">
        <div class="grid grid-cols-1 lg:grid-cols-12 w-full">
            <div class="col-span-1 lg:col-span-6">
                {{ $slot }}
            </div>
            <div class="col-span-1 lg:col-span-6 bg-primary hidden lg:flex items-center">
                <div class="text-justify p-8 w-full">
                    <div class="flex justify-center">
                        <a href="/">
                            <x-application-logo class="w-48 h-48 fill-current text-black" />
                        </a>
                    </div>
                    <div class="mt-8 text-center">
                        <h1 class="font-bold text-4xl text-text dark:text-text-50 leading-relaxed">
                            {{ __('محاسبه هزینه‌ پروژه‌های خود را آسان کنید.') }}
                        </h1>
                        <p class="text-center mt-6 font-normal text-sm text-text-700 dark:text-text-200">
                            {{ __('هزینه و سود هر پروژه را محاسبه و با سایر پروژهای خود مقایسه کنید تا بهترین پروژه از نظر سود دهی را انتخاب کنید.') }}
                            {{ __('لیست پروژه‌ها را همیشه به همراه خود داشته باشید تا در هر زمان و مکان به آن‌ها دسترسی داشته باشید و یا با همکاران خود به اشتراک بگذارید.') }}
                        </p>
                        <p class="text-center mt-12 font-normal text-xs text-text-700 dark:text-text-200">
                            {{ __('نسخه') }}<span
                                class="ms-2 font-bold text-md text-text-950 dark:text-text-50">{{ __(config('app.version')) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
