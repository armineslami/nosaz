<section>
    <x-card class="bg-red-200 dark:bg-red-800">
        <div class="mb-6">
            <p class="text-text text-lg font-bold mb-2">{{ __('حذف حساب کاربری') }}</p>
            <p class="text-text-600 dark:text-gray-300 text-sm justify-center">
                {{ __('با حذف کردن حساب کاربری، تمام اطلاعات شما از بین خواهد رفت و برای ورود مجدد نیاز به ثبت نام خواهید داشت.') }}
            </p>
        </div>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="flex justify-end my-4">
                <x-danger-button class="justify-end" type="button" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'destroy-account')">
                    {{ __('حذف حساب کاربری') }}
                </x-danger-button>
            </div>

            <x-modal name="destroy-account" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <div class="p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-bold text-text">
                            {{ __('حذف حساب کاربری') }}
                        </h2>

                        <p class="mt-1 text-sm text-text-600 dark:text-gray-400">
                            @if (!Auth::user()->google_id && !Auth::user()->twitter_id && !Auth::user()->telegram_id)
                                {{ __('برای تایید لطفا کلمه عبور حساب کاربری خود را وارد نمایید.') }}
                            @else
                                {{ __('آیا از حذف حساب کاربری خود اطمینان دارید؟') }}
                            @endif
                        </p>
                    </div>

                    @if (!Auth::user()->google_id && !Auth::user()->twitter_id && !Auth::user()->telegram_id)
                        <div class="space-y-4">
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('کلمه عبور') }}
                                </label>
                                <x-text-input type="password" name="password" class="w-full"
                                    placeholder="{{ __('کلمه عبور') }}" required>
                                </x-text-input>
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>
                        </div>
                    @endif

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('انصراف') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('تایید') }}
                        </x-danger-button>
                    </div>
                </div>
            </x-modal>
        </form>
    </x-card>
</section>
