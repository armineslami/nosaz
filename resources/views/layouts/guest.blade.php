<!DOCTYPE html>
<html class="dark:dark" dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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

    @include('layouts.head')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                            <x-logo width="12rem" height="12rem" primaryColor="#5F5F5F" secondaryColor="#ffffff"
                                background="" />
                        </a>
                    </div>
                    <div class="mt-8 text-center">
                        <h1 class="font-bold text-4xl text-text dark:text-text-50 leading-relaxed">
                            {{ __('محاسبات پروژه‌های خود را آسان کنید.') }}
                        </h1>
                        <p class="text-center mt-6 font-normal text-sm text-text-700 dark:text-text-200">
                            {{ __('هزینه و سود هر پروژه را محاسبه کنید تا بهترین را از نظر سود دهی را انتخاب کنید.') }}
                            {{ __('لیست پروژه‌ها را همیشه به همراه خود داشته باشید تا در هر زمان و مکان به آن‌ها دسترسی داشته باشید و یا با دوستان خود به اشتراک بگذارید.') }}
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

    @include('components.pwa-install-prompt-ios')
    @include('components.pwa-install-prompt-android')

    <script>
        let runAnimation = true;
        window.addEventListener("open-modal", (event) => {
            const modalName = event.detail;
            if (modalName === "android-pwa-install-prompt" || modalName === "ios-pwa-install-prompt") {
                startAnimation(modalName === "ios-pwa-install-prompt" ? "pwa-logo-ios-prompt" :
                    "pwa-logo-android-prompt");
                const modal = document.querySelector(modalName === "ios-pwa-install-prompt" ?
                    ".ios-pwa-install-prompt" : ".android-pwa-install-prompt");
                modal.addEventListener("close", (event) => {
                    runAnimation = false;
                });
            }
        });

        function startAnimation(logoId) {
            const logo = document.getElementById(logoId);
            const homes = logo.querySelector("svg").getElementById("homes");
            const home = logo.querySelector("svg").getElementById("home");
            const moon = logo.querySelector("svg").getElementById("moon");
            const sun = logo.querySelector("svg").getElementById("sun");

            setTimeout(() => {
                day();
            }, 2000);

            function day() {
                if (!runAnimation) return;
                moon.classList.remove("move-down-animation");
                moon.classList.add("move-up-animation");
                setTimeout(() => {
                    sun.classList.add("move-down-animation");
                    sun.classList.remove("hidden");
                    logo.classList.remove("change-background-to-dark-animation");
                    logo.classList.add("change-background-to-light-animation");
                    homes.classList.remove("change-stroke-to-light-animation");
                    homes.classList.add("change-stroke-to-dark-animation");
                    setTimeout(() => {
                        night();
                    }, 3000)
                }, 200);
            }

            function night() {
                if (!runAnimation) return;
                sun.classList.remove("move-down-animation");
                sun.classList.add("move-up-animation");
                setTimeout(() => {
                    moon.classList.remove("move-up-animation");
                    moon.classList.add("move-down-animation");
                    logo.classList.remove("change-background-to-light-animation");
                    logo.classList.add("change-background-to-dark-animation");
                    homes.classList.remove("change-stroke-to-dark-animation");
                    homes.classList.add("change-stroke-to-light-animation");
                    setTimeout(() => {
                        day();
                    }, 3000)
                }, 200);
            }
        }
    </script>
</body>

</html>
