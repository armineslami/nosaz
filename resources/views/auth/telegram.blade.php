<x-basic-layout>
    <div class="flex items-center min-h-screen">
        <div class="m-auto">
            <div class="px-8 py-16 bg-white dark:bg-gray-800 rounded-lg">
                <div class="flex w-[fit-content] relative -right-1 mx-auto items-center mb-12 ltr">
                    <x-application-logo class="size-16 rounded-full bg-primary px-2" />
                    <svg class="size-16 stroke-gray-400 relative -right-0.5" fill="currentColor" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                    </svg>
                    <svg class="w-[4.7rem]" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="16" cy="16" r="14" fill="url(#paint0_linear_87_7225)" />
                        <path
                            d="M22.9866 10.2088C23.1112 9.40332 22.3454 8.76755 21.6292 9.082L7.36482 15.3448C6.85123 15.5703 6.8888 16.3483 7.42147 16.5179L10.3631 17.4547C10.9246 17.6335 11.5325 17.541 12.0228 17.2023L18.655 12.6203C18.855 12.4821 19.073 12.7665 18.9021 12.9426L14.1281 17.8646C13.665 18.3421 13.7569 19.1512 14.314 19.5005L19.659 22.8523C20.2585 23.2282 21.0297 22.8506 21.1418 22.1261L22.9866 10.2088Z"
                            fill="white" />
                        <defs>
                            <linearGradient id="paint0_linear_87_7225" x1="16" y1="2" x2="16"
                                y2="30" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#37BBFE" />
                                <stop offset="1" stop-color="#007DBB" />
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <p id="telegram-click-on-button-text" class="hidden text-text text-center text-xs">
                    {{ __('برای ورود با تلگرام روی دکمه زیر کلیک کنید') }}
                </p>

                <p id="telegram-spinner-text" class="text-text text-center text-xs">
                    {{ __('در حال اتصال به تلگرام') }}
                </p>

                <div class="mt-12">
                    <div id="telegram-spinner" class="flex" role="status">
                        <div class="mx-auto">
                            <svg aria-hidden="true"
                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-accent"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="m-auto hidden" id="telegram-button">
                        {!! Socialite::driver('telegram')->getButton() !!}
                    </div>
                </div>
                <p onclick="history.back()"
                    class="w-full text-center mt-8 text-sm text-text-600 dark:text-text-600 hover:text-gray-900 dark:hover:text-gray-100 cursor-pointer">
                    {{ __('بازگشت') }}
                </p>
            </div>
        </div>
    </div>

    <script>
        function hide() {
            const telegramButton = document.getElementById('telegram-button');
            const telegramSpinner = document.getElementById('telegram-spinner');
            const telegramSpinnerText = document.getElementById('telegram-spinner-text');
            const telegramClickText = document.getElementById('telegram-click-on-button-text');
            telegramSpinner.classList.add('hidden');
            telegramSpinnerText.classList.add('hidden');
            telegramClickText.classList.remove('hidden');
            telegramButton.classList.remove('hidden');
        }

        // Create a MutationObserver to watch for the iframe's addition to the DOM
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                mutation.addedNodes.forEach((node) => {
                    // Check if the added node is the iframe with the correct ID
                    if (node.id === 'telegram-login-Nosaz_bot') {
                        // Set up load event listener on the iFrame
                        node.addEventListener('load', function() {
                            try {
                                hide();
                            } catch (error) {
                                console.error('Unable to access iframe content:', error);
                            }
                        });

                        // iFrame is found and listener is set, so stop observing
                        observer.disconnect();
                    }
                });
            });
        });

        // Start observing the #telegram-button div for child element additions
        observer.observe(document.getElementById('telegram-button'), {
            childList: true,
        });
    </script>
</x-basic-layout>
