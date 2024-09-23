<aside
    class="fixed top-0 start-0 z-40 w-64 h-screen py-4 px-8 transition-transform translate-x-full bg-background border-e-4 border-gray-200 dark:border-gray-700 md:translate-x-0 "
    aria-label="Sidenav"
    id="drawer-navigation"
>
    <div class="flex items-center">
        <x-application-logo class="w-12 h-12 bg-primary rounded-lg px-1 " />
        <div class="relative ms-4">
            <span class="absolute left-0 right-0 m-auto w-[fit-content] bottom-2">🏗‍</span>
            <p class="text-text font-bold text-xl tracking-tight">{{ __('نوســـــــــــــــــاز') }}</p>
        </div>
    </div>

    <div class="mt-12">
        <a
            class="flex items-center px-4 py-2 mt-0 rounded-md {{ Route::is('dashboard') ? 'bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
            href="{{ route('dashboard') }}">
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            <span class="ms-4 text-sm">{{ __('داشبورد') }}</span>
        </a>
        <a
            class="flex items-center px-4 py-2 mt-6 rounded-md {{ Route::is('projects.edit') ? 'primary-button bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
            href="{{ route('projects.edit') }}">
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
            <span class="ms-4 text-sm">{{ __('پروژه‌ها') }}</span>
        </a>
        <a
            class="flex items-center px-4 py-2 mt-6 rounded-md {{ Route::is('formula.edit') ? 'primary-button bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
            href="{{ route('formula.edit') }}">
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
            <span class="ms-4 text-sm">{{ __('فرمول ساز') }}</span>
        </a>
        <a
            class="flex items-center px-4 py-2 mt-6 rounded-md {{ Route::is('reports') ? 'primary-button flex bg-primary text-text-900 dark:text-text-100' : 'primary-button text-gray-900 dark:text-gray-100 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary' }}"
            href="{{ route('reports') }}">
            <svg  class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
            </svg>
            <span class="ms-4 text-sm">{{ __('گزارشات') }}</span>
        </a>
                <div id="effect-area" class="relative text-gray-500 dark:text-gray-600 text-center text-xs mb-2 cursor-pointer">
                    <div class="relative text-center inline-flex">
                        <span>✨</span>
                        <span class="font-bold mx-1" >Armin</span>
                        <span>Crafted with caffeine by</span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-600 text-center text-xs">
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

    mainArea.addEventListener('mouseenter', function () {
        let delay = 300;

        // Start generating sparkles repeatedly while hovering
        sparkleInterval = setInterval(() => {
            createSparkle(this);
        }, delay); // Generate a sparkle every 300ms
    });

    mainArea.addEventListener('mouseleave', function () {
        // Stop generating sparkles when the mouse leaves
        clearInterval(sparkleInterval);
    });

    function createSparkle(element) {
        const emojis = ['✨'];
        const sparkle = document.createElement('span');
        sparkle.classList.add('sparkle');
        // sparkle.textContent = '✨';
        sparkle.textContent = emojis[Math.round(Math.random() * emojis.length -1)];

        // Get the position of the "✨" emoji and place the new sparkles near it
        const sparkleX = mainArea.getBoundingClientRect();  // Keep it near the right of the text
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
