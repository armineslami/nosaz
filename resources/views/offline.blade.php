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

    <!--
        Since the name of the css file is random, a helper method
        gives the exact name of the css file inside build fodlder.
    -->
    @if ($cssPath = asset_from_manifest('resources/css/app.css'))
        <link rel="stylesheet" href="{{ $cssPath }}">
    @endif
</head>

<body class="text-text-950 dark:text-text-50 antialiased bg-background">
    <div>
        <div class="mt-16 md:mt-32">
            <div class="relative">
                <svg class="w-[300px] h-[250px] md:w-[450px] md:h-[300px] absolute top-0 left-0 bottom-0 right-0 m-auto fill-gray-300 dark:fill-gray-800 opacity-20"
                    id="visual" viewBox="0 0 900 600">
                    <g transform="translate(415.80122448615737 318.1032235833984)">
                        <path id="blob1"
                            d="M173 -164.4C223 -123 261.5 -61.5 257.5 -4C253.5 53.5 207 107 157 141.2C107 175.3 53.5 190.2 -2.5 192.6C-58.5 195.1 -116.9 185.2 -148.2 151.1C-179.4 116.9 -183.5 58.5 -187.1 -3.7C-190.8 -65.8 -194 -131.5 -162.8 -172.9C-131.5 -214.2 -65.8 -231.1 -2.1 -229C61.5 -226.9 123 -205.7 173 -164.4">
                        </path>
                    </g>
                    <g class="hidden" transform="translate(454.2142609407367 284.35799449039416)">
                        <path id="blob2"
                            d="M145.7 -126.9C195.7 -95.7 247.8 -47.8 247.8 0C247.8 47.8 195.7 95.7 145.7 139.2C95.7 182.7 47.8 221.8 1.8 220.1C-44.3 218.3 -88.6 175.6 -138.3 132.1C-188 88.6 -243 44.3 -254.1 -11.1C-265.1 -66.5 -232.3 -132.9 -182.6 -164.2C-132.9 -195.4 -66.5 -191.5 -9.3 -182.2C47.8 -172.9 95.7 -158.2 145.7 -126.9">
                        </path>
                    </g>
                </svg>
                <svg class="w-[280px] h-[150px] md:w-[300px] md:h-[200px] absolute top-0 left-0 bottom-0 right-0 m-auto fill-gray-300 dark:fill-gray-400 opacity-40"
                    id="visual" viewBox="0 0 900 600">
                    <g transform="translate(415.80122448615737 318.1032235833984)">
                        <path id="blob3"
                            d="M173 -164.4C223 -123 261.5 -61.5 257.5 -4C253.5 53.5 207 107 157 141.2C107 175.3 53.5 190.2 -2.5 192.6C-58.5 195.1 -116.9 185.2 -148.2 151.1C-179.4 116.9 -183.5 58.5 -187.1 -3.7C-190.8 -65.8 -194 -131.5 -162.8 -172.9C-131.5 -214.2 -65.8 -231.1 -2.1 -229C61.5 -226.9 123 -205.7 173 -164.4">
                        </path>
                    </g>
                    <g class="hidden" transform="translate(454.2142609407367 284.35799449039416)">
                        <path id="blob4"
                            d="M145.7 -126.9C195.7 -95.7 247.8 -47.8 247.8 0C247.8 47.8 195.7 95.7 145.7 139.2C95.7 182.7 47.8 221.8 1.8 220.1C-44.3 218.3 -88.6 175.6 -138.3 132.1C-188 88.6 -243 44.3 -254.1 -11.1C-265.1 -66.5 -232.3 -132.9 -182.6 -164.2C-132.9 -195.4 -66.5 -191.5 -9.3 -182.2C47.8 -172.9 95.7 -158.2 145.7 -126.9">
                        </path>
                    </g>
                </svg>
                <svg class="w-[250px] h-[100px] md:w-[200px] md:h-[150px] absolute top-0 left-0 bottom-0 right-0 m-auto fill-gray-300 dark:fill-gray-300 opacity-60"
                    id="visual" viewBox="0 0 900 600">
                    <g transform="translate(415.80122448615737 318.1032235833984)">
                        <path id="blob5"
                            d="M173 -164.4C223 -123 261.5 -61.5 257.5 -4C253.5 53.5 207 107 157 141.2C107 175.3 53.5 190.2 -2.5 192.6C-58.5 195.1 -116.9 185.2 -148.2 151.1C-179.4 116.9 -183.5 58.5 -187.1 -3.7C-190.8 -65.8 -194 -131.5 -162.8 -172.9C-131.5 -214.2 -65.8 -231.1 -2.1 -229C61.5 -226.9 123 -205.7 173 -164.4">
                        </path>
                    </g>
                    <g class="hidden" transform="translate(454.2142609407367 284.35799449039416)">
                        <path id="blob6"
                            d="M145.7 -126.9C195.7 -95.7 247.8 -47.8 247.8 0C247.8 47.8 195.7 95.7 145.7 139.2C95.7 182.7 47.8 221.8 1.8 220.1C-44.3 218.3 -88.6 175.6 -138.3 132.1C-188 88.6 -243 44.3 -254.1 -11.1C-265.1 -66.5 -232.3 -132.9 -182.6 -164.2C-132.9 -195.4 -66.5 -191.5 -9.3 -182.2C47.8 -172.9 95.7 -158.2 145.7 -126.9">
                        </path>
                    </g>
                </svg>
                <svg style="position: relative; margin: auto; width: 6rem;" viewBox="0 0 447.173788 422.139909"
                    version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Main">
                            <g id="Group" transform="translate(123.572633, 148.000000)" stroke="#C6C3C3"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="18">
                                <path
                                    d="M56.2123859,93.1775294 C74.3213725,75.0523243 103.678627,75.0523243 121.787614,93.1775294 M28.1061929,65.0414569 C61.7329297,31.3701293 116.258237,31.3701293 149.893807,65.0414569 M0,36.9053843 C49.1549226,-12.3017948 128.845077,-12.3017948 178,36.9053843 M93.6814212,121.313602 L89,126 L84.3185788,121.313602 C86.9049982,118.727653 91.0950018,118.727653 93.6814212,121.313602 L93.6814212,121.313602 Z"
                                    id="Shape"></path>
                            </g>
                            <line x1="212.572633" y1="105" x2="212.572663" y2="234.791082" id="Path"
                                stroke="#2B2B2B" stroke-width="24" stroke-linecap="round" stroke-linejoin="round">
                            </line>
                            <circle id="Oval" fill="#2B2B2B" cx="212.572633" cy="268" r="16"></circle>
                        </g>
                    </g>
                </svg>
            </div>

            <div class="text-center mt-16 md:mt-32">
                <p class="text-text text-sm font-bold mb-2 mt-8">
                    {{ __('اینترنت قطع است') }}</p>
                <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
                    {{ __('دسترسی خود به اینترنت را بررسی کنید') }}</p>

                <a href="{{ route('home') }}">
                    <x-primary-button class="mt-16">
                        {{ __('تلاش مجدد') }}
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
