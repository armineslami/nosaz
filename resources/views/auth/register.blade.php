<x-guest-layout>

    <div class="flex items-center min-h-screen">
        <div class="p-8 w-full">
            <h1 class="text-start text-2xl font-bold text-text">
                {{ __('ثبت نام') }}
            </h1>

            <!-- oAuth Login -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mt-12">
                <!-- Google -->
                <a class="col-span-6" href="">
                    <x-secondary-button class="w-full items-center !bg-transparent !border-primary">
                        <span class="mx-auto flex flex-row">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" class="l"><g id="google"><g id="google-vector" fill-rule="evenodd" clip-rule="evenodd"><path id="Shape" fill="#4285F4" d="M20.64 12.205q-.002-.957-.164-1.84H12v3.48h4.844a4.14 4.14 0 0 1-1.796 2.717v2.258h2.908c1.702-1.567 2.684-3.874 2.684-6.615"></path><path id="Shape_2" fill="#34A853" d="M12 21c2.43 0 4.468-.806 5.957-2.18L15.05 16.56c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H3.958v2.332A9 9 0 0 0 12.001 21"></path><path id="Shape_3" fill="#FBBC05" d="M6.964 13.712a5.4 5.4 0 0 1-.282-1.71c0-.593.102-1.17.282-1.71V7.96H3.957A9 9 0 0 0 3 12.002c0 1.452.348 2.827.957 4.042z"></path><path id="Shape_4" fill="#EA4335" d="M12 6.58c1.322 0 2.508.455 3.441 1.346l2.582-2.58C16.463 3.892 14.427 3 12 3a9 9 0 0 0-8.043 4.958l3.007 2.332c.708-2.127 2.692-3.71 5.036-3.71"></path></g></g></svg>
                            <span class="mt-1 ms-2 text-text">{{ __('ثبت نام با گوگل') }}</span>
                        </span>
                    </x-secondary-button>
                </a>

                <!-- Microsoft -->
                <a class="col-span-6" href="">
                    <x-secondary-button class="w-full items-center !bg-transparent !border-primary">
                        <span class="mx-auto flex flex-row">
                            <svg class="mt-0.5" width="1.66em" height="1.85em" viewBox="0 0 128 110">
                                <path fill="#f1511b" d="M51.939 51.939H0V0h51.939z" />
                                <path fill="#80cc28" d="M109.287 51.939H57.348V0h51.939z" />
                                <path fill="#00adef" d="M51.938 109.307H0V57.368h51.938z" />
                                <path fill="#fbbc09" d="M109.287 109.307H57.348V57.368h51.939z" />
                            </svg>
                            <span class="mt-1 ms-2 text-text">{{ __('ثبت نام با مایکروسافت') }}</span>
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
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-accent shadow-sm focus:ring-accent dark:focus:ring-accent dark:focus:ring-offset-gray-800">
                        <span class="ms-2 mt-0.5 text-xs text-text-600 dark:text-text-600">
                            {{ __('پذیرش') }}
                            <a class="mx-2 text-accent font-bold" href="#">{{ __('قوانین استفاده از سرویس') }}</a>
                            {{ __('و') }}
                            <a class="mx-2 text-accent font-bold" href="#">{{ __('سیاست حفظ حریم شخصی') }}</a>
                        </span>
                    </label>
                </div>

                <x-primary-button class="w-full items-center py-3 mt-6">
                    <span class="text-text text-center w-full">{{ __('ثبت نام') }}</span>
                </x-primary-button>
            </form>

            <div class="flex text-sm text-text-600 dark:text-text-600 mt-6">
                <p>{{ __('حساب کاربری دارید؟') }}</p>
                <a class="text-primary hover:text-primary-700 dark:hover:text-primary-700 ms-2 font-bold" href="{{ route('login') }}">{{ __('ورود') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
