<section>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('اطلاعات حساب کاربری') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('اطلاعات حساب کاربری خود را آپدیت کنید.') }}
        </p>
    </div>

    <x-card class="mt-8">
        {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form> --}}

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('register.name') }}
                    </label>
                    <x-text-input id="name" name="name" type="text" class="w-full" required
                        placeholder="{{ __('register.name') }}" :value="old('name', $user->name)">
                    </x-text-input>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('register.email') }}
                    </label>
                    <x-text-input type="text" class="w-full" required disabled
                        placeholder="{{ __('register.email') }}" :value="old('email', $user->email)">
                    </x-text-input>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                    @endif --}}
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button class="justify-end">
                    {{ __('آپدیت') }}
                </x-primary-button>
            </div>
        </form>

        @if (session('status') === 'profile-updated')
            <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)" class="hidden"
                icon='<svg class="w-5 h-5 text-text" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>'
                message="{{ __('حساب کاربری با موفقیت آپدیت شد') }}" />
        @endif
    </x-card>
</section>
