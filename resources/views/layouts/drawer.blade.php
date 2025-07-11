<aside
    class="fixed top-0 start-0 z-40 w-64 h-screen py-4 px-8 transition-transform translate-x-full bg-background border-e-4 border-gray-200 dark:border-gray-700 md:translate-x-0 "
    aria-label="Sidenav" id="drawer-navigation">
    <div class="relative h-full">
        <div class="flex items-center">
            <div class="hidden dark:block">
                <x-logo width="48px" height="48px" background="" />
            </div>
            <div class="block dark:hidden">
                <x-logo width="48px" height="48px" primaryColor="#1D1E1F" background="" />
            </div>
            <div class="relative ms-0">
                <span class="absolute left-[0.55rem] m-auto w-[fit-content] bottom-2">🏗‍</span>
                <p class="text-text font-bold text-xl tracking-tight">{{ __('نوســـــــــــــــــ ز') }}</p>
            </div>
        </div>

        <div class="mt-16">
            <div>
                {{-- <a class="flex items-center px-4 py-2 mt-0 rounded-md {{ Route::is('dashboard') ? 'bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
                    href="{{ route('dashboard') }}">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    <span class="ms-4 text-sm">{{ __('داشبورد') }}</span>
                </a> --}}
                <div>
                    <div aria-controls="project-dropdown" data-collapse-toggle="project-dropdown"
                        class="flex relative cursor-pointer items-center px-4 py-2 mt-4 rounded-md {{ Route::is('project.*') ? 'primary-button bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                        <span class="ms-4 text-sm">{{ __('پروژه‌ها') }}</span>
                        <svg class="w-2 h-2 absolute end-5 bottom-0 top-0 m-auto" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="m1 1 4 4 4-4" />
                        </svg>
                    </div>
                    <ul id="project-dropdown" class="{{ Route::is('project.*') ? '' : 'hidden' }} py-2 space-y-1 mt-1">
                        <li>
                            <a href="{{ route('project.create') }}"
                                class="flex text-xs w-full ms-4 px-4 py-2 {{ Route::is('project.create') || Route::is('project.calculate') ? 'text-text bg-primary-200 dark:bg-primary-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-75 rounded-md pl-11 group">
                                {{ __('محاسبه') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('project.index') }}"
                                class="flex text-xs w-full ms-4 px-4 py-2 {{ Route::is('project.index') || Route::is('project.search') ? 'text-text bg-primary-200 dark:bg-primary-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-75 rounded-md pl-11 group">
                                {{ __('پروژه‌ها') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div aria-controls="formula-dropdown" data-collapse-toggle="formula-dropdown"
                        class="flex cursor-pointer items-center px-4 py-2 mt-4 rounded-md {{ Route::is('formula.*') ? 'primary-button bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                        </svg>
                        <span class="ms-4 text-sm">{{ __('فرمول‌ها') }}</span>
                        <span
                            class="bg-accent rounded border-0 text-xsmall px-1 py-0.5 ms-2 text-white font-bold">{{ __('آزمایشی') }}</span>
                        <svg class="w-2 h-2 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="m1 1 4 4 4-4" />
                        </svg>
                    </div>
                    <ul id="formula-dropdown" class="{{ Route::is('formula.*') ? '' : 'hidden' }} py-2 space-y-1 mt-1">
                        <li>
                            <a href="{{ route('formula.create') }}"
                                class="flex text-xs w-full ms-4 px-4 py-2 {{ Route::is('formula.create') ? 'text-text bg-primary-200 dark:bg-primary-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-75 rounded-md pl-11 group">
                                {{ __('ساخت فرمول') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('formula.index') }}"
                                class="flex text-xs w-full ms-4 px-4 py-2 {{ Route::is('formula.index') ? 'text-text bg-primary-200 dark:bg-primary-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-75 rounded-md pl-11 group">
                                {{ __('فرمول‌ها') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('formula.variable.create') }}"
                                class="flex text-xs w-full ms-4 px-4 py-2 {{ Route::is('formula.variable.create') ? 'text-text bg-primary-200 dark:bg-primary-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-75 rounded-md pl-11 group">
                                {{ __('متغیرها') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('formula.label.create') }}"
                                class="flex text-xs w-full ms-4 px-4 py-2 {{ Route::is('formula.label.create') ? 'text-text bg-primary-200 dark:bg-primary-100' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }} transition duration-75 rounded-md pl-11 group">
                                {{ __('برچسب‌ها') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="flex items-center px-4 py-2 mt-4 rounded-md {{ Route::is('settings.*') ? 'primary-button flex bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
                    href="{{ route('settings.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="ms-4 text-sm">{{ __('تنظیمات') }}</span>
                </a>
                {{-- <a class="flex items-center px-4 py-2 mt-2 rounded-md {{ Route::is('reports') ? 'primary-button flex bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
                    href="{{ route('reports') }}">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>
                    <span class="ms-4 text-sm">{{ __('گزارشات') }}</span>
                </a> --}}
            </div>

            <div class="absolute bottom-0 left-0 right-0">

                <div class="mb-4">
                    <a class="flex items-center px-4 py-2 mt-4 rounded-md text-gray-500 dark:text-gray-600"
                        target="_blank" href="{{ route('terms') }}">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <span class="ms-4 text-xs">{{ __('قوانین سرویس') }}</span>
                    </a>

                    <a class="flex items-center px-4 py-2 mt-1 rounded-md text-gray-500 dark:text-gray-600"
                        target="_blank" href="{{ route('policy') }}">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>

                        <span class="ms-4 text-xs">{{ __('سیاست حریم شخصی') }}</span>
                    </a>
                </div>

                <div data-modal-target="social-modal" data-modal-toggle="social-modal" id="effect-area"
                    class="relative text-gray-500 dark:text-gray-600 text-center text-xs mb-0 cursor-pointer">
                    <div class="relative text-center inline-flex">
                        <span>✨</span>
                        <span class="font-bold mx-1">Armin</span>
                        <span>Crafted with caffeine by</span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-600 text-center text-xs ltr">
                        {{ config('app.version') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</aside>

<script>
    let sparkleInterval;
    const mainArea = document.getElementById('effect-area');

    mainArea.addEventListener('mouseenter', function() {
        // Generate a sparkle with delay
        let delay = 300;

        // Start generating sparkles repeatedly while hovering
        sparkleInterval = setInterval(() => {
            createSparkle(this);
        }, delay);
    });

    mainArea.addEventListener('mouseleave', function() {
        // Stop generating sparkles when the mouse leaves
        clearInterval(sparkleInterval);
    });

    function createSparkle(element) {
        const emojis = ['✨'];
        const sparkle = document.createElement('span');
        sparkle.classList.add('sparkle');
        // sparkle.textContent = '✨';
        sparkle.textContent = emojis[Math.round(Math.random() * emojis.length - 1)];

        // Get the position of the "✨" emoji and place the new sparkles near it
        const sparkleX = mainArea.getBoundingClientRect(); // Keep it near the right of the text
        const sparkleY = Math.random() * 20 - 20; // Small random vertical offset

        // Set the position of the sparkle relative to the main star
        sparkle.style.left = `${sparkleX}px`;
        sparkle.style.top = `${sparkleY}px`;

        // Append the sparkle to the container
        element.appendChild(sparkle);

        // Trigger the animation
        setTimeout(() => {
            sparkle.classList.add('sparkle-fade-up');
        }, 100); // Delay the fade effect slightly

        // Remove the sparkle after the animation ends
        setTimeout(() => {
            sparkle.remove();
        }, 1500); // 1.5 seconds to disappear
    }
</script>
