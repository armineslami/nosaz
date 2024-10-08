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

        <main class="p-2 md:p-8 pb-20 md:pb-8 pt-24">
            {{ $slot }}
        </main>

        @include('layouts.bottom-navigation')
    </div>

    <!-- Social modal -->
    @include('layouts.social-modal')

</div>
</body>
</html>
