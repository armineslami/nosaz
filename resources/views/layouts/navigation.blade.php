<nav class="bg-background border-b-4 border-gray-200 dark:border-gray-700 px-2 md:px-4 py-3.5 fixed right-0 md:right-[16rem] left-0 z-20 w-full md:w-[calc(100%-16rem)]">
    <div class="flex flex-wrap flex-row items-center">
        <div class="flex basis-3/4 items-center">
            <!-- Hamburger Button -->
            {{--            <button--}}
            {{--                data-drawer-target="drawer-navigation"--}}
            {{--                data-drawer-toggle="drawer-navigation"--}}
            {{--                aria-controls="drawer-navigation"--}}
            {{--                class="md:hidden p-2 text-gray-500 dark:text-gray-400 rounded-lg cursor-pointer hover:text-text-900 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:hover:bg-gray-700 dark:hover:text-white"--}}
            {{--            >--}}
            {{--                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
            {{--                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />--}}
            {{--                </svg>--}}
            {{--                <span class="sr-only">Toggle sidebar</span>--}}
            {{--            </button>--}}

            {{--            <a href="{{ route('dashboard') }}" class="flex items-center justify-between mr-4">--}}
            {{--                <x-application-logo class="w-12 h-12 text-black" />--}}
            {{--                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('خانه') }}</span>--}}
            {{--            </a>--}}

            {{--            <a href="https://flowbite.com" class="flex items-center justify-between mr-4">--}}
            {{--                <img--}}
            {{--                    src="https://flowbite.s3.amazonaws.com/logo.svg"--}}
            {{--                    class="mr-3 h-8"--}}
            {{--                    alt="Flowbite Logo"--}}
            {{--                />--}}
            {{--                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>--}}
            {{--            </a>--}}

            <!-- User Icon (sm) -->
{{--            <button--}}
{{--                type="button"--}}
{{--                class="md:hidden flex text-sm p-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"--}}
{{--                aria-expanded="false"--}}
{{--                data-dropdown-toggle="sm-dropdown"--}}
{{--            >--}}
{{--                <span class="sr-only">Open user menu</span>--}}
{{--                <img--}}
{{--                    class="w-8 h-8 rounded-full"--}}
{{--                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png"--}}
{{--                    alt="user photo"--}}
{{--                />--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />--}}
{{--                </svg>--}}
{{--            </button>--}}

            <!-- Search -->
            <form action="#" method="GET" class=" w-full block">
                <label for="top-bar-search" class="sr-only">Search</label>
                <div class="relative">
                    <div
                        class="flex absolute inset-y-0 left-0 items-center px-3 cursor-pointer"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        <svg
                            class="w-5 h-5 text-gray-500 dark:text-gray-400"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            ></path>
                        </svg>
                    </div>

                    <x-text-input id="search" class="block w-full"
                                  placeholder="{{ __('navigation.search_for_project') }}"
                                  type="text"
                                  name="query"
                                  required />
                </div>
            </form>
        </div>

        <!-- Nav Icons -->
        <div class="flex justify-end basis-1/4 items-center lg:order-2">

            <!-- Search -->
            {{--            <button--}}
            {{--                type="button"--}}
            {{--                data-drawer-toggle="drawer-navigation"--}}
            {{--                aria-controls="drawer-navigation"--}}
            {{--                class="p-2 me-2 text-gray-500 rounded-lg md:hidden hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"--}}
            {{--            >--}}
            {{--                <span class="sr-only">Toggle search</span>--}}
            {{--                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">--}}
            {{--                    <path clip-rule="evenodd" fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"></path>--}}
            {{--                </svg>--}}
            {{--            </button>--}}

            <!-- Settings -->
            <button
                type="button"
                class="hidden md:block p-2 me-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            >
                <span class="sr-only">Settings</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>

            <div class="hidden md:block bg-gray-200 dark:bg-gray-700 w-0.5 h-8 ms-0 me-2"></div>

            <!-- User Icon -->
            <button
                type="button"
                class="flex text-sm p-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                aria-expanded="false"
                data-dropdown-toggle="md-dropdown"
            >
                <span class="sr-only">Open user menu</span>
{{--                <img--}}
{{--                    class="w-8 h-8 rounded-full"--}}
{{--                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png"--}}
{{--                    alt="user photo"--}}
{{--                />--}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </button>

            <!-- Notifications -->
            {{--            <button--}}
            {{--                type="button"--}}
            {{--                data-dropdown-toggle="notification-dropdown"--}}
            {{--                class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"--}}
            {{--            >--}}
            {{--                <span class="sr-only">View notifications</span>--}}
            {{--                <!-- Bell icon -->--}}
            {{--                <svg--}}
            {{--                    aria-hidden="true"--}}
            {{--                    class="w-6 h-6"--}}
            {{--                    fill="currentColor"--}}
            {{--                    viewBox="0 0 20 20"--}}
            {{--                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                >--}}
            {{--                    <path--}}
            {{--                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"--}}
            {{--                    ></path>--}}
            {{--                </svg>--}}
            {{--            </button>--}}

            <!-- Notification dropdown menu -->
            {{--            <div--}}
            {{--                class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700 rounded-xl"--}}
            {{--                id="notification-dropdown"--}}
            {{--            >--}}
            {{--                <div--}}
            {{--                    class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-600 dark:text-gray-300"--}}
            {{--                >--}}
            {{--                    Notifications--}}
            {{--                </div>--}}
            {{--                <div>--}}
            {{--                    <a--}}
            {{--                        href="#"--}}
            {{--                        class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600"--}}
            {{--                    >--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <img--}}
            {{--                                class="w-11 h-11 rounded-full"--}}
            {{--                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"--}}
            {{--                                alt="Bonnie Green avatar"--}}
            {{--                            />--}}
            {{--                            <div--}}
            {{--                                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-primary-700 dark:border-gray-700"--}}
            {{--                            >--}}
            {{--                                <svg--}}
            {{--                                    aria-hidden="true"--}}
            {{--                                    class="w-3 h-3 text-white"--}}
            {{--                                    fill="currentColor"--}}
            {{--                                    viewBox="0 0 20 20"--}}
            {{--                                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                >--}}
            {{--                                    <path--}}
            {{--                                        d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"--}}
            {{--                                    ></path>--}}
            {{--                                    <path--}}
            {{--                                        d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"--}}
            {{--                                    ></path>--}}
            {{--                                </svg>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="pl-3 w-full">--}}
            {{--                            <div--}}
            {{--                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"--}}
            {{--                            >--}}
            {{--                                New message from--}}
            {{--                                <span class="font-semibold text-gray-900 dark:text-white"--}}
            {{--                                >Bonnie Green</span--}}
            {{--                                >: "Hey, what's up? All set for the presentation?"--}}
            {{--                            </div>--}}
            {{--                            <div--}}
            {{--                                class="text-xs font-medium text-primary-600 dark:text-primary-500"--}}
            {{--                            >--}}
            {{--                                a few moments ago--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                    <a--}}
            {{--                        href="#"--}}
            {{--                        class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600"--}}
            {{--                    >--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <img--}}
            {{--                                class="w-11 h-11 rounded-full"--}}
            {{--                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"--}}
            {{--                                alt="Jese Leos avatar"--}}
            {{--                            />--}}
            {{--                            <div--}}
            {{--                                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-gray-900 rounded-full border border-white dark:border-gray-700"--}}
            {{--                            >--}}
            {{--                                <svg--}}
            {{--                                    aria-hidden="true"--}}
            {{--                                    class="w-3 h-3 text-white"--}}
            {{--                                    fill="currentColor"--}}
            {{--                                    viewBox="0 0 20 20"--}}
            {{--                                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                >--}}
            {{--                                    <path--}}
            {{--                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"--}}
            {{--                                    ></path>--}}
            {{--                                </svg>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="pl-3 w-full">--}}
            {{--                            <div--}}
            {{--                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"--}}
            {{--                            >--}}
            {{--                    <span class="font-semibold text-gray-900 dark:text-white"--}}
            {{--                    >Jese leos</span--}}
            {{--                    >--}}
            {{--                                and--}}
            {{--                                <span class="font-medium text-gray-900 dark:text-white"--}}
            {{--                                >5 others</span--}}
            {{--                                >--}}
            {{--                                started following you.--}}
            {{--                            </div>--}}
            {{--                            <div--}}
            {{--                                class="text-xs font-medium text-primary-600 dark:text-primary-500"--}}
            {{--                            >--}}
            {{--                                10 minutes ago--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                    <a--}}
            {{--                        href="#"--}}
            {{--                        class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600"--}}
            {{--                    >--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <img--}}
            {{--                                class="w-11 h-11 rounded-full"--}}
            {{--                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"--}}
            {{--                                alt="Joseph McFall avatar"--}}
            {{--                            />--}}
            {{--                            <div--}}
            {{--                                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-red-600 rounded-full border border-white dark:border-gray-700"--}}
            {{--                            >--}}
            {{--                                <svg--}}
            {{--                                    aria-hidden="true"--}}
            {{--                                    class="w-3 h-3 text-white"--}}
            {{--                                    fill="currentColor"--}}
            {{--                                    viewBox="0 0 20 20"--}}
            {{--                                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                >--}}
            {{--                                    <path--}}
            {{--                                        fill-rule="evenodd"--}}
            {{--                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"--}}
            {{--                                        clip-rule="evenodd"--}}
            {{--                                    ></path>--}}
            {{--                                </svg>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="pl-3 w-full">--}}
            {{--                            <div--}}
            {{--                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"--}}
            {{--                            >--}}
            {{--                    <span class="font-semibold text-gray-900 dark:text-white"--}}
            {{--                    >Joseph Mcfall</span--}}
            {{--                    >--}}
            {{--                                and--}}
            {{--                                <span class="font-medium text-gray-900 dark:text-white"--}}
            {{--                                >141 others</span--}}
            {{--                                >--}}
            {{--                                love your story. See it and view more stories.--}}
            {{--                            </div>--}}
            {{--                            <div--}}
            {{--                                class="text-xs font-medium text-primary-600 dark:text-primary-500"--}}
            {{--                            >--}}
            {{--                                44 minutes ago--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                    <a--}}
            {{--                        href="#"--}}
            {{--                        class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600"--}}
            {{--                    >--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <img--}}
            {{--                                class="w-11 h-11 rounded-full"--}}
            {{--                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"--}}
            {{--                                alt="Roberta Casas image"--}}
            {{--                            />--}}
            {{--                            <div--}}
            {{--                                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-green-400 rounded-full border border-white dark:border-gray-700"--}}
            {{--                            >--}}
            {{--                                <svg--}}
            {{--                                    aria-hidden="true"--}}
            {{--                                    class="w-3 h-3 text-white"--}}
            {{--                                    fill="currentColor"--}}
            {{--                                    viewBox="0 0 20 20"--}}
            {{--                                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                >--}}
            {{--                                    <path--}}
            {{--                                        fill-rule="evenodd"--}}
            {{--                                        d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"--}}
            {{--                                        clip-rule="evenodd"--}}
            {{--                                    ></path>--}}
            {{--                                </svg>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="pl-3 w-full">--}}
            {{--                            <div--}}
            {{--                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"--}}
            {{--                            >--}}
            {{--                    <span class="font-semibold text-gray-900 dark:text-white"--}}
            {{--                    >Leslie Livingston</span--}}
            {{--                    >--}}
            {{--                                mentioned you in a comment:--}}
            {{--                                <span--}}
            {{--                                    class="font-medium text-primary-600 dark:text-primary-500"--}}
            {{--                                >@bonnie.green</span--}}
            {{--                                >--}}
            {{--                                what do you say?--}}
            {{--                            </div>--}}
            {{--                            <div--}}
            {{--                                class="text-xs font-medium text-primary-600 dark:text-primary-500"--}}
            {{--                            >--}}
            {{--                                1 hour ago--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                    <a--}}
            {{--                        href="#"--}}
            {{--                        class="flex py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600"--}}
            {{--                    >--}}
            {{--                        <div class="flex-shrink-0">--}}
            {{--                            <img--}}
            {{--                                class="w-11 h-11 rounded-full"--}}
            {{--                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/robert-brown.png"--}}
            {{--                                alt="Robert image"--}}
            {{--                            />--}}
            {{--                            <div--}}
            {{--                                class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-purple-500 rounded-full border border-white dark:border-gray-700"--}}
            {{--                            >--}}
            {{--                                <svg--}}
            {{--                                    aria-hidden="true"--}}
            {{--                                    class="w-3 h-3 text-white"--}}
            {{--                                    fill="currentColor"--}}
            {{--                                    viewBox="0 0 20 20"--}}
            {{--                                    xmlns="http://www.w3.org/2000/svg"--}}
            {{--                                >--}}
            {{--                                    <path--}}
            {{--                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"--}}
            {{--                                    ></path>--}}
            {{--                                </svg>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="pl-3 w-full">--}}
            {{--                            <div--}}
            {{--                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"--}}
            {{--                            >--}}
            {{--                    <span class="font-semibold text-gray-900 dark:text-white"--}}
            {{--                    >Robert Brown</span--}}
            {{--                    >--}}
            {{--                                posted a new video: Glassmorphism - learn how to implement--}}
            {{--                                the new design trend.--}}
            {{--                            </div>--}}
            {{--                            <div--}}
            {{--                                class="text-xs font-medium text-primary-600 dark:text-primary-500"--}}
            {{--                            >--}}
            {{--                                3 hours ago--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            {{--                <a--}}
            {{--                    href="#"--}}
            {{--                    class="block py-2 text-md font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-600 dark:text-white dark:hover:underline"--}}
            {{--                >--}}
            {{--                    <div class="inline-flex items-center">--}}
            {{--                        <svg--}}
            {{--                            aria-hidden="true"--}}
            {{--                            class="mr-2 w-4 h-4 text-gray-500 dark:text-gray-400"--}}
            {{--                            fill="currentColor"--}}
            {{--                            viewBox="0 0 20 20"--}}
            {{--                            xmlns="http://www.w3.org/2000/svg"--}}
            {{--                        >--}}
            {{--                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>--}}
            {{--                            <path--}}
            {{--                                fill-rule="evenodd"--}}
            {{--                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"--}}
            {{--                                clip-rule="evenodd"--}}
            {{--                            ></path>--}}
            {{--                        </svg>--}}
            {{--                        View all--}}
            {{--                    </div>--}}
            {{--                </a>--}}
            {{--            </div>--}}

            <!-- User dropdown menu -->
{{--            <div id="sm-dropdown" class="hidden">--}}
{{--                <x-user-dropdown />--}}
{{--            </div>--}}
            <div id="md-dropdown" class="hidden">
                <x-user-dropdown />
            </div>
        </div>
    </div>
</nav>
