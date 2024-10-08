<div class="block md:hidden fixed bottom-0 left-0 z-10 w-full h-16 bg-background border-t border-gray-200 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        <a href="{{ route('dashboard') }}" type="button" class="inline-flex flex-col items-center justify-center px-5 group {{ Route::is('dashboard') ? 'bg-primary' : 'hover:bg-primary' }}">
            <svg class="w-5 h-5 mb-2 {{ Route::is('dashboard') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            <span class="text-xs {{ Route::is('dashboard') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}">{{ __('داشبورد') }}</span>
        </a>
        <a href="{{ route('projects.edit') }}" type="button" class="inline-flex flex-col items-center justify-center px-5 group {{ Route::is('projects.edit') ? 'bg-primary' : 'hover:bg-primary' }}">
            <svg class="w-5 h-5 mb-2 {{ Route::is('projects.edit') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
            <span class="text-xs {{ Route::is('projects') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}">{{ __('پروژه‌ها') }}</span>
        </a>
        <a data-popover-target="formula-menu-popover" href="{{ route('formula.index') }}" type="button" class="inline-flex flex-col items-center justify-center px-5 group {{ Route::is('formula.*') ? 'bg-primary' : 'hover:bg-primary' }}">
            <svg class="w-5 h-5 mb-2 {{ Route::is('formula.*') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
            <div class="flex items-center">
                <span class="text-xs {{ Route::is('formula.*') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}">{{ __('فرمول‌ها') }}</span>
                <span class="bg-accent rounded border-0 text-xsmall px-0.5 ms-1 text-white font-bold">{{ __('آزمایشی') }}</span>
            </div>
        </a>
        <div data-popover id="formula-menu-popover" role="tooltip" class="absolute z-11 invisible inline-block w-[fit-content] transition-opacity duration-300 bg-white dark:bg-gray-700  border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm opacity-0">
            <ul class="mb-2">
                <li>
                    <a href="{{ route('formula.create') }}" class="flex text-sm w-ful px-4 py-2 text-gray-500 dark:text-gray-400 transition duration-75 rounded-md pl-11 group hover:bg-gray-100 dark:hover:bg-gray-700">
                        {{ __('ساخت فرمول') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('formula.index') }}" class="flex text-sm w-full px-4 py-2 text-gray-500 dark:text-gray-400 transition duration-75 rounded-md pl-11 group hover:bg-gray-100 dark:hover:bg-gray-700">
                        {{ __('فرمول‌ها') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('formula.variable.create') }}" class="flex text-sm w-full px-4 py-2 text-gray-500 dark:text-gray-400 transition duration-75 rounded-md pl-11 group hover:bg-gray-100 dark:hover:bg-gray-700">
                        {{ __('متغیرها') }}
                    </a>
                </li>
            </ul>
            <div data-popper-arrow></div>
        </div>
        <a href="{{ route('reports') }}" type="button" class="inline-flex flex-col items-center justify-center px-5 group {{ Route::is('reports') ? 'bg-primary' : 'hover:bg-primary' }}">
            <svg class="w-5 h-5 mb-2 {{ Route::is('reports') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
            </svg>
            <span class="text-xs {{ Route::is('reports') ? 'text-text-900 dark:text-text-100' : 'text-gray-900 dark:text-gray-100 group-hover:text-text-900 dark:group-hover:text-text-100' }}">{{ __('گزارشات') }}</span>
        </a>
    </div>
</div>
