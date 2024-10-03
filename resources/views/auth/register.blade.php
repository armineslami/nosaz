<x-guest-layout>

    <div class="flex lg:items-center min-h-screen">
        <div class="p-8 w-full">
            <h1 class="text-start text-2xl font-bold text-text">
                {{ __('ثبت نام') }}
            </h1>

            <!-- Session Status -->
{{--            <x-auth-session-status class="my-8" :status="session('status')" />--}}

            <!-- oAuth Login -->
            <div class="grid grid-cols-12 gap-4 mt-12">
                <!-- Google -->
                <a class="col-span-6" href="{{ route("google.redirect") }}">
                    <x-secondary-button class="w-full items-center">
                        <span class="mx-auto flex flex-row">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="l"><g id="google"><g id="google-vector" fill-rule="evenodd" clip-rule="evenodd"><path id="Shape" fill="#4285F4" d="M20.64 12.205q-.002-.957-.164-1.84H12v3.48h4.844a4.14 4.14 0 0 1-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.874 2.684-6.615"></path><path id="Shape_2" fill="#34A853" d="M12 21c2.43 0 4.468-.806 5.957-2.18L15.05 16.56c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H3.958v2.332A9 9 0 0 0 12.001 21"></path><path id="Shape_3" fill="#FBBC05" d="M6.964 13.712a5.4 5.4 0 0 1-.282-1.71c0-.593.102-1.17.282-1.71V7.96H3.957A9 9 0 0 0 3 12.002c0 1.452.348 2.827.957 4.042z"></path><path id="Shape_4" fill="#EA4335" d="M12 6.58c1.322 0 2.508.455 3.441 1.346l2.582-2.58C16.463 3.892 14.427 3 12 3a9 9 0 0 0-8.043 4.958l3.007 2.332c.708-2.127 2.692-3.71 5.036-3.71"></path></g></g></svg>
                            <span class="mt-1 ms-2 text-text">{{ __('ثبت نام با گوگل') }}</span>
                        </span>
                    </x-secondary-button>
                </a>

                <!-- Twitter -->
                <a class="col-span-6" href="{{ route("twitter.redirect") }}">
                    <x-secondary-button class="w-full items-center">
                        <span class="mx-auto flex flex-row">
                            <svg class="relative top-0.5" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                            </svg>
                            <span class="mt-1 ms-2 text-text">{{ __('ثبت نام با x') }}</span>
                        </span>
                    </x-secondary-button>
                </a>
            </div>

            <div class="grid grid-cols-12 my-8 text-center items-center">
                <hr class="col-span-5" />
                <small class="col-span-2 text-text font-bold">{{ __('یا') }}</small>
                <hr class="col-span-5" />
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('نام')" />
                        <x-text-input id="name" class="block mt-4 w-full"
                                      placeholder="{{ __('نام و نام خانوادگی') }}"
                                      type="text"
                                      name="name"
                                      :value="old('name')"
                                      required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-2 lg:mt-0">
                        <x-input-label for="email" :value="__('ایمیل')" />
                        <x-text-input id="email" class="block mt-4 w-full"
                                      placeholder="{{ __('ایمیل خود را وارد کنید') }}"
                                      type="email"
                                      name="email"
                                      :value="old('email')"
                                      required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-2 lg:mt-4">
                        <x-input-label for="password" :value="__('کلمه عبور')" />
                        <x-text-input id="password" class="block mt-4 w-full"
                                      placeholder="{{ __('کلمه عبور خود را وارد کنید') }}"
                                      type="password"
                                      name="password"
                                      required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-2 lg:mt-4">
                        <x-input-label for="password_confirmation" :value="__('تکرار کلمه عبور')" />
                        <x-text-input id="password_confirmation" class="block mt-4 w-full"
                                      placeholder="{{ __('تکرار کلمه عبور خود را وارد کنید') }}"
                                      type="password"
                                      name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="flex mt-10">
                    <label for="terms_and_policy" class="inline-flex items-center">
                        <input id="terms_and_policy" type="checkbox" name="terms" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-accent shadow-sm focus:ring-accent dark:focus:ring-accent dark:focus:ring-offset-gray-800">
                        <x-label-darken-text class="ms-2">
                            {{ __('پذیرش') }}
                            <a class="mx-2 text-text font-bold" href="{{ route('terms') }}" target="_blank">
                                {{ __('قوانین استفاده از سرویس') }}
                            </a>
                            {{ __('و') }}
                            <a class="mx-2 text-text font-bold" href="{{ route('policy') }}" target="_blank">
                                {{ __('سیاست حفظ حریم شخصی') }}
                            </a>
                        </x-label-darken-text>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('terms')" class="mt-3" />

                <x-primary-button class="w-full items-center py-3 mt-6">
                    <span class="text-text text-center w-full">{{ __('ثبت نام') }}</span>
                </x-primary-button>
            </form>

            <div class="flex text-sm mt-6">
                <x-label-darken-text class="mt-0.5">
                    {{ __('حساب کاربری دارید؟') }}
                </x-label-darken-text>
                <a class="text-primary hover:text-primary-700 dark:hover:text-primary-700 ms-2 font-bold" href="{{ route('login') }}">{{ __('ورود') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
