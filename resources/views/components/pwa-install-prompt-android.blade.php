<x-modal id="android-pwa-install-prompt" maxWidth="md" name="android-pwa-install-prompt" focusable>
    <div class="android-pwa-install-prompt px-4 py-12 md:px-12 md:py-12 flex flex-col items-center">
        <div class="border-b flex flex-col items-center pb-8">
            <div id="pwa-logo-android-prompt" style="background: #1D1E1F"
                class='w-[fit-content] px-2 py-2 rounded-xl mb-8'>
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
            <p class="text-sm text-text text-center justify-center">
                {{ __('نرم افزار ') . __('app.name') . ' را برای استفاده از تمامی امکانات روی دستگاه خود نصب کنید.' }}
            </p>
        </div>

        <ul class="my-8 text-sm text-text text-center space-y-4">
            <li>{{ __('۱- در نوار بالا روی گزینه ') }}
                <span class="text-text">
                    <svg class="size-4 inline-block" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>

                </span> {{ __('بزنید.') }}
            </li>
            <li>
                {{ __('۲- گزینه ') }}
                <p class="text-text ltr inline-block">
                    Install App
                    <svg class="size-4 inline-block fill-text-text" viewBox="0 0 24 24" fill="currentColor">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M17 18H7V6h7V1H7c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2v-5h-2v2z" />
                        <path d="M18 14l5-5-1.41-1.41L19 10.17V3h-2v7.17l-2.59-2.58L13 9z" />
                    </svg>

                </p>
                {{ __('را انتخاب نمایید.') }}
            </li>
            <li>{{ __('۳- گزینه ') }} <span class="text-blue-500">Ok</span>
                {{ __('را انتخاب نمایید.') }}</li>
        </ul>

        <x-primary-button class="mt-4 w-full" type="button" x-on:click="$dispatch('close')">
            {{ __('متوجه شدم') }}
        </x-primary-button>
    </div>
</x-modal>
