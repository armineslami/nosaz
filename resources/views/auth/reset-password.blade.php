<x-basic-layout>
    <div class="flex md:items-center min-h-screen">
        <div class="w-full md:w-1/2 m-4 mt-8 md:m-auto md:mt-auto">

            {{-- <x-application-logo class="m-auto w-24 h-24 mb-8 rounded-lg px-2 bg-primary" /> --}}

            <div>
                <p class="text-text text-lg font-bold mb-2">{{ __('تغییر کلمه عبور') }}</p>
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

                    <div class="flex items-center justify-between mt-8">
                        <a href="{{ route('login') }}"
                            class="text-sm text-text-600 dark:text-text-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 cursor-pointer">
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
