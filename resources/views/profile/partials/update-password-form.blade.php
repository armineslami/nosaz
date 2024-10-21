<section>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('تغییر کلمه عبور') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('از یک کلمه عبور طولانی و غیر قابل حدس استفاده کنید.') }}
        </p>
    </div>

    <x-card class="mt-8">
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4">
                <div class="mb-4">
                    <label for="current_password"
                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('reset-password.current_password') }}
                    </label>
                    <x-text-input id="current_password" name="current_password" type="password" class="w-full" required
                        placeholder="{{ __('reset-password.current_password') }}" autocomplete="current-password">
                    </x-text-input>
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('reset-password.password') }}
                    </label>
                    <x-text-input id="password" name="password" type="password" class="w-full" required
                        placeholder="{{ __('reset-password.password') }}" autocomplete="new-password">
                    </x-text-input>
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation"
                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('reset-password.confirm_password') }}
                    </label>
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="w-full"
                        required placeholder="{{ __('reset-password.confirm_password') }}" autocomplete="new-password">
                    </x-text-input>
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button class="justify-end">
                    {{ __('آپدیت') }}
                </x-primary-button>
            </div>
        </form>

        @if (session('status') === 'password-updated')
            <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)" class="hidden"
                icon='<svg class="w-5 h-5 text-text" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>'
                message="{{ __('کلمه عبور با موفقیت آپدیت شد') }}" />
        @endif
    </x-card>
</section>
