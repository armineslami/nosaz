<x-modal id="update-app-prompt" maxWidth="md" name="update-app-prompt" focusable>
    <div class="update-app-prompt px-4 py-12 md:px-12 md:py-12 flex flex-col items-center">
        <div class="flex flex-col items-center pb-8">
            <div id="update-app-prompt" style="background: #1D1E1F" class='w-[fit-content] px-2 py-2 rounded-xl mb-8'>
                <svg width="64px" height="64px" viewBox="0 0 428.339869 272.758591" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Main" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Icons" transform="translate(-2453.644046, -119.977711)">
                            <g id="Black-Inner-White" transform="translate(2412.000000, 0.000000)">
                                <g id="Group" transform="translate(41.644046, 119.977711)">
                                    <rect id="home" fill="#48998B" x="93.4081393" y="83.5559381" width="122.686095"
                                        height="189.202653" rx="12"></rect>
                                    <path
                                        d="M0,260.990242 L54.5248811,260.990242 C56.7340201,260.990242 58.5248811,259.199381 58.5248811,256.990242 L58.5248811,171.046886 C58.5248811,169.494238 59.4233813,168.081854 60.8297058,167.423852 L249.335681,79.2241232 C250.742006,78.5661205 251.640506,77.1537366 251.640506,75.6010885 L251.640506,4 C251.640506,1.790861 249.849645,-2.47250396e-15 247.640506,-1.42108547e-14 L166.64141,-1.42108547e-14 C164.432271,1.44774501e-15 162.64141,1.790861 162.64141,4 L162.64141,227.265209 C162.64141,229.474348 164.432271,231.265209 166.64141,231.265209 L340.244026,231.265209 C342.453165,231.265209 344.244026,229.474348 344.244026,227.265209 L344.244026,154.307615 C344.244026,152.928237 343.533324,151.646187 342.363503,150.915297 L259.380973,99.0688691 C257.507448,97.8983144 255.039733,98.4681846 253.869179,100.34171 C253.47942,100.965536 253.269225,101.684756 253.261705,102.420293 L251.681819,256.949349 C251.659235,259.158372 253.431693,260.967448 255.640717,260.990033 C255.654348,260.990172 255.667979,260.990242 255.68161,260.990242 L428.339869,260.990242 L428.339869,260.990242"
                                        id="homes" stroke="#FFFFFF" stroke-width="24"></path>
                                    <ellipse id="moon" fill="#48998B" cx="313.695561" cy="53.9916994"
                                        rx="41.3880802" ry="40.6490074"></ellipse>
                                    <g id="sun" class="hidden">
                                        <text font-family="AppleColorEmoji, Apple Color Emoji" font-size="92"
                                            font-weight="normal" fill="#000000">
                                            <tspan x="380.355954" y="92">☀️</tspan>
                                        </text>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <p class="text-sm text-text font-bold text-center justify-center">
                {{ __('نسخه جدید ') . __('app.name') . ' از راه رسید!' }}
            </p>
            <p class="text-sm text-text mt-4 text-center justify-center">
                {{ __('نسخه ') }}
                <span class="ltr">&lrm;{{ config('app.version') }}&lrm;</span>
                {{ __(' روی دستگاه شما نصب شد. برای استفاده از این نسخه، نرم افزار مجددا بارگذاری خواهد شد.') }}
            </p>
        </div>

        <x-primary-button class="mt-4 w-full" type="button" x-on:click="$dispatch('close')">
            {{ __('متوجه شدم') }}
        </x-primary-button>
    </div>

    <script>
        window.addEventListener("open-modal", (event) => {
            const modalName = event.detail;
            if (modalName === "update-app-prompt") {
                startAnimation("update-app-prompt");
            }
        });

        window.addEventListener("modal-closed", (event) => {
            const modalName = event.detail;
            console.log(event.detail);
            if (modalName === "update-app-prompt") {
                window.location.reload();
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
</x-modal>
