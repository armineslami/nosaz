<div
    class="block md:hidden fixed bottom-0 left-0 z-10 w-full h-16 bg-background border-t border-gray-200 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
        {{-- <a href="{{ route('dashboard') }}" type="button"
            class="inline-flex flex-col items-center justify-center px-5 group">
            <svg class="w-5 h-5 mb-2 {{ Route::is('dashboard') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            <span
                class="text-xs {{ Route::is('dashboard') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}">{{ __('داشبورد') }}</span>
        </a> --}}
        <a data-popover-target="project-menu-popover" type="button"
            class="inline-flex flex-col items-center justify-center px-5 group cursor-pointer">
            <svg class="w-5 h-5 mb-2 {{ Route::is('project.*') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
            <span
                class="text-xs {{ Route::is('project.*') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100 ' }}">{{ __('پروژه‌ها') }}</span>
        </a>
        <div data-popover id="project-menu-popover" role="tooltip"
            class="absolute z-11 invisible inline-block w-[fit-content] transition-opacity duration-300 bg-white dark:bg-gray-700  border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm opacity-0">
            <ul class="mb-2">
                <li>
                    <a href="{{ route('project.create') }}"
                        class="flex text-sm w-ful px-4 py-2 {{ Route::is('project.create') ? 'bg-primary text-text-900 dark:text-text-100 border-b border-b-primary-400' : 'text-text hover:text-text-900 hover:dark:text-text-100' }} transition duration-75 pl-11 group hover:bg-primary">
                        {{ __('ساخت پروژه') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('project.index') }}"
                        class="flex text-sm w-full px-4 py-2 {{ Route::is('project.index') || Route::is('project.search') ? 'bg-primary text-text-900 dark:text-text-100 border-b border-b-primary-400' : 'text-text hover:text-text-900 hover:dark:text-text-100' }} transition duration-75 pl-11 group hover:bg-primary">
                        {{ __('پروژه‌ها') }}
                    </a>
                </li>
            </ul>
            <div data-popper-arrow></div>
        </div>
        <a data-popover-target="formula-menu-popover" type="button"
            class="inline-flex flex-col items-center justify-center px-5 group cursor-pointer">
            <svg class="w-5 h-5 mb-2 {{ Route::is('formula.*') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
            </svg>
            <div class="flex items-center">
                <span
                    class="text-xs {{ Route::is('formula.*') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}">{{ __('فرمول‌ها') }}</span>
                <span
                    class="bg-accent rounded border-0 text-xsmall px-1 py-0.5 ms-1 text-white font-bold">{{ __('آزمایشی') }}</span>
            </div>
        </a>
        <div data-popover id="formula-menu-popover" role="tooltip"
            class="absolute z-11 invisible inline-block w-[fit-content] transition-opacity duration-300 bg-white dark:bg-gray-700  border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm opacity-0">
            <ul class="mb-2">
                <li>
                    <a href="{{ route('formula.create') }}"
                        class="flex text-sm w-ful px-4 py-2 {{ Route::is('formula.create') ? 'bg-primary text-text-900 dark:text-text-100 border-b border-b-primary-400' : 'text-text hover:text-text-900 hover:dark:text-text-100' }} transition duration-75 pl-11 group hover:bg-primary">
                        {{ __('ساخت فرمول') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('formula.index') }}"
                        class="flex text-sm w-full px-4 py-2 {{ Route::is('formula.index') ? 'bg-primary text-text-900 dark:text-text-100 border-b border-b-primary-400' : 'text-text hover:text-text-900 hover:dark:text-text-100' }} transition duration-75 pl-11 group hover:bg-primary">
                        {{ __('فرمول‌ها') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('formula.variable.create') }}"
                        class="flex text-sm w-full px-4 py-2 {{ Route::is('formula.variable.create') ? 'bg-primary text-text-900 dark:text-text-100 border-b border-b-primary-400' : 'text-text hover:text-text-900 hover:dark:text-text-100' }} transition duration-75 pl-11 group hover:bg-primary">
                        {{ __('متغیرها') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('formula.label.create') }}"
                        class="flex text-sm w-full px-4 py-2 {{ Route::is('formula.variable.create') ? 'bg-primary text-text-900 dark:text-text-100 border-b border-b-primary-400' : 'text-text hover:text-text-900 hover:dark:text-text-100' }} transition duration-75 pl-11 group hover:bg-primary">
                        {{ __('برچسب‌ها') }}
                    </a>
                </li>
            </ul>
            <div data-popper-arrow></div>
        </div>
        <a href="{{ route('settings.edit') }}" type="button"
            class="inline-flex flex-col items-center justify-center px-5 group">
            <svg class="w-5 h-5 mb-2 {{ Route::is('settings.*') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span
                class="text-xs {{ Route::is('settings.*') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}">{{ __('تنظیمات') }}</span>
        </a>
        {{-- <a href="{{ route('reports') }}" type="button"
            class="inline-flex flex-col items-center justify-center px-5 group">
            <svg class="w-5 h-5 mb-2 {{ Route::is('reports') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
            </svg>
            <span
                class="text-xs {{ Route::is('reports') ? 'text-primary-500 dark:text-primary' : 'text-gray-900 dark:text-gray-100' }}">{{ __('گزارشات') }}</span>
        </a> --}}
    </div>
</div>
