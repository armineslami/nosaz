<x-basic-layout>
    <div class="flex md:items-center min-h-screen">
        <div class="w-full md:w-1/2 m-4 mt-8 md:m-auto md:mt-auto">

            {{-- <x-application-logo class="m-auto w-24 h-24 mb-8 rounded-lg px-2 bg-primary" /> --}}

            <div>
                <div class="flex">
                    <a href="{{ route('login') }}"
                        class="flex md:hidden h-[fit-content] me-2  text-sm p-2 relative bottom-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary">
                        <span class="sr-only">{{ __('بازگشت') }}</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <p class="text-text text-lg font-bold mb-2">{{ __('تغییر کلمه عبور') }}</p>
                </div>
                <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
                    {{ __('از یک کلمه عبور طولانی و غیر قابل حدس استفاده کنید.') }}
                </p>
            </div>

            <x-card class="mt-8 max-w-7xl mx-auto">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('reset-password.email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('reset-password.password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('reset-password.confirm_password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end md:justify-between mt-8">
                        <a href="{{ route('login') }}"
                            class="hidden md:block text-sm text-text-600 dark:text-text-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 cursor-pointer">
                            {{ __('بازگشت') }}
                        </a>
                        <x-primary-button>
                            {{ __('reset-password.reset_password') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-basic-layout>
