<!DOCTYPE html>
<html class="dark:dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @vite(['resources/css/app.css'])
    </head>
    <body class="antialiased ">
        <div class="relative flex items-top justify-center min-h-screen bg-background items-center sm:pt-0">
            <div class="">
                <div class="px-4 text-5xl md:text-[5rem] lg:text-[6rem] text-center text-text {{ app()->getLocale() === 'en' ? 'tracking-wider': ''}}">
                    @yield('code')
                </div>

                <div class="text-xs lg:text-md text-center text-gray-500 {{ app()->getLocale() === 'en' ? 'tracking-wider': ''}}">
                    @yield('message')
                </div>

                <div class="mt-12">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center justify-center gap-2 text-center text-sm text-text">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        <p>{{ __('بازگشت') }}</p>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
