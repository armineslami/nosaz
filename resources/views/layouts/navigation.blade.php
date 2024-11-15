<nav
    class="bg-background border-b-4 border-gray-200 dark:border-gray-700 px-4 md:px-4 py-3.5 fixed right-0 md:right-[16rem] left-0 z-20 w-full md:w-[calc(100%-16rem)]">
    <div class="flex flex-wrap flex-row items-center">
        <div class="flex basis-10/12 items-center">
            <!-- Search -->
            <form action="{{ route('project.search') }}" method="GET" class=" w-full block">
                <label for="top-bar-search" class="sr-only">{{ __('جستجو') }}</label>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center px-3 cursor-pointer"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                            </path>
                        </svg>
                    </div>

                    <x-text-input id="search"
                        class="block w-full {{ !empty(request()->query('query')) ? 'ps-12' : 'ps-4' }}"
                        placeholder="{{ __('navigation.search_for_project') }}" type="text" name="query"
                        :value="request()->query('query') ?: null" required />

                    @if (!empty(request()->query('query')))
                        <span class="flex absolute -inset-y-1.5 right-0 items-center px-3 h-full cursor-pointer"
                            onclick="window.location.href = '/project'">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white mt-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18 18 6m0 12L6 6" />
                            </svg>
                        </span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Nav Icons -->
        <div class="flex justify-end basis-2/12 items-center lg:order-2">
            <!-- User Icon -->
            <button type="button"
                class="flex text-sm p-2 text-gray-500 rounded-lg {{ Route::is('profile.*') ? 'text-text-900 bg-primary dark:text-text-100 dark:bg-primary' : 'hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary' }} focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                aria-expanded="false" data-dropdown-toggle="md-dropdown">
                <span class="sr-only">Open user menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </button>

            <div id="md-dropdown" class="hidden">
                <x-user-dropdown />
            </div>
        </div>
    </div>
</nav>
