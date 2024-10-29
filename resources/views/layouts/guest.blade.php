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
                        <div id="guest-logo" class='w-[fit-content] px-2 py-2 rounded-xl mb-8'>
                            <svg class="pt-24 -mt-24" width="216px" height="216px" viewBox="0 0 428.339869 272.758591"
                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Main" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Icons" transform="translate(-2453.644046, -119.977711)">
                                        <g id="Black-Inner-White" transform="translate(2412.000000, 0.000000)">
                                            <g id="Group" transform="translate(41.644046, 119.977711)">
                                                <rect id="home" fill="#ffffff" x="93.4081393" y="83.5559381"
                                                    width="122.686095" height="189.202653" rx="12"></rect>
                                                <path
                                                    d="M0,260.990242 L54.5248811,260.990242 C56.7340201,260.990242 58.5248811,259.199381 58.5248811,256.990242 L58.5248811,171.046886 C58.5248811,169.494238 59.4233813,168.081854 60.8297058,167.423852 L249.335681,79.2241232 C250.742006,78.5661205 251.640506,77.1537366 251.640506,75.6010885 L251.640506,4 C251.640506,1.790861 249.849645,-2.47250396e-15 247.640506,-1.42108547e-14 L166.64141,-1.42108547e-14 C164.432271,1.44774501e-15 162.64141,1.790861 162.64141,4 L162.64141,227.265209 C162.64141,229.474348 164.432271,231.265209 166.64141,231.265209 L340.244026,231.265209 C342.453165,231.265209 344.244026,229.474348 344.244026,227.265209 L344.244026,154.307615 C344.244026,152.928237 343.533324,151.646187 342.363503,150.915297 L259.380973,99.0688691 C257.507448,97.8983144 255.039733,98.4681846 253.869179,100.34171 C253.47942,100.965536 253.269225,101.684756 253.261705,102.420293 L251.681819,256.949349 C251.659235,259.158372 253.431693,260.967448 255.640717,260.990033 C255.654348,260.990172 255.667979,260.990242 255.68161,260.990242 L428.339869,260.990242 L428.339869,260.990242"
                                                    id="homes" stroke="#5F5F5F" stroke-width="24"></path>
                                                <ellipse id="moon" fill="#ffffff" cx="313.695561" cy="53.9916994"
                                                    rx="41.3880802" ry="40.6490074"></ellipse>
                                                <g id="sun" class="hidden">
                                                    <text font-family="AppleColorEmoji, Apple Color Emoji"
                                                        font-size="92" font-weight="normal" fill="#000000">
                                                        <tspan x="355.355954" y="92">☀️</tspan>
                                                    </text>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-0 text-center">
                        <h1 class="font-bold text-4xl text-text dark:text-text-50 leading-relaxed">
                            {{ __('محاسبات پروژه‌های خود را آسان کنید.') }}
                        </h1>
                        <p class="text-center mt-6 font-normal text-sm text-text-700 dark:text-text-200">
                            {{ __('هزینه و سود هر پروژه را محاسبه کنید تا بهترین را از نظر سود دهی را انتخاب کنید.') }}
                            {{ __('لیست پروژه‌ها را همیشه به همراه خود داشته باشید تا در هر زمان و مکان به آن‌ها دسترسی داشته باشید و یا با دوستان خود به اشتراک بگذارید.') }}
                        </p>
                        <div class="text-center mt-12 font-normal text-xs text-text-700 dark:text-text-200 ltr">
                            <span class="ms-2 font-bold text-md text-text-950 dark:text-text-50">
                                {{ __(config('app.version')) }}
                            </span>
                            <span class="">{{ __('نسخه') }}</span>
                        </div>
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

        document.addEventListener("DOMContentLoaded", () => {
            const guestlogo = document.getElementById("guest-logo");
            const guestMoon = guestlogo.querySelector("svg").getElementById("moon");
            const guestSun = guestlogo.querySelector("svg").getElementById("sun");

            setTimeout(() => {
                guestDay();
            }, 3000);

            function guestDay() {
                if (!runAnimation) return;
                guestMoon.classList.remove("move-down-animation");
                guestMoon.classList.add("move-up-animation");
                setTimeout(() => {
                    guestSun.classList.add("move-down-animation");
                    guestSun.classList.remove("hidden");
                    setTimeout(() => {
                        guestNight();
                    }, 5000)
                }, 200);
            }

            function guestNight() {
                guestSun.classList.remove("move-down-animation");
                guestSun.classList.add("move-up-animation");
                setTimeout(() => {
                    guestMoon.classList.remove("move-up-animation");
                    guestMoon.classList.add("move-down-animation");
                    setTimeout(() => {
                        guestDay();
                    }, 5000)
                }, 200);
            }
        })
    </script>
</body>

</html>
