<x-app-layout>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('تنظیمات') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('برای بخش‌های مختلف، تنظیمات دلخواه خود را اعمال کنید.') }}
        </p>
    </div>
    <x-card class="mt-8 max-w-7xl mx-auto">
        <form method="post" action="{{ route('settings.update') }}">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-2">
                    <label for="app_theme" class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('رنگ نرم افزار') }}
                    </label>
                    <x-select class="w-full" name="app_theme">
                        <option value="system"
                            {{ (old('app_theme') !== null && old('app_theme') == 'system') || $settings->app_theme === 'system' ? 'selected' : '' }}>
                            {{ __('سیستم') }}
                        </option>
                        <option value="light"
                            {{ (old('app_theme') !== null && old('app_theme') == 'light') || $settings->app_theme === 'light' ? 'selected' : '' }}>
                            {{ __('روشن') }}
                        </option>
                        <option value="dark"
                            {{ (old('app_theme') !== null && old('app_theme') == 'dark') || $settings->app_theme === 'dark' ? 'selected' : '' }}>
                            {{ __('تاریک') }}
                        </option>
                    </x-select>
                    <x-input-error :messages="$errors->get('app_theme')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="app_paginate_number"
                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('تعداد ردیف در جدول‌') }}
                    </label>
                    <x-text-input type="number" name="app_paginate_number" class="w-full" required
                        placeholder="{{ __('تعداد ردیف در جدول‌') }}" :value="old('app_paginate_number') ?? $settings->app_paginate_number">
                    </x-text-input>
                    <x-input-error :messages="$errors->get('app_paginate_number')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="app_max_decimal_place"
                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('تعداد رقم اعشار در محاسبات') }}
                    </label>
                    <x-text-input type="number" name="app_max_decimal_place" class="w-full" required
                        placeholder="{{ __('تعداد رقم اعشار') }}" :value="old('app_max_decimal_place') ?? $settings->app_max_decimal_place">
                    </x-text-input>
                    <x-input-error :messages="$errors->get('app_max_decimal_place')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="app_max_decimal_place"
                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('نمایش فرمول‌های پیش فرض') }}
                    </label>
                    <x-select class="w-full" name="app_show_default_formula">
                        <option value="0"
                            {{ (old('app_show_default_formula') !== null && old('app_show_default_formula') == '0') || $settings->app_show_default_formula === '0' ? 'selected' : '' }}>
                            {{ __('غیرفعال') }}
                        </option>
                        <option value="1"
                            {{ (old('app_show_default_formula') !== null && old('app_show_default_formula') == '1') || $settings->app_show_default_formula === '1' ? 'selected' : '' }}>
                            {{ __('فعال') }}
                        </option>
                    </x-select>
                    <x-input-error :messages="$errors->get('app_scalable')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="app_max_decimal_place"
                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                        {{ __('زوم خودکار در صفحات کوچک') }}
                    </label>
                    <x-select class="w-full" name="app_scalable">
                        <option value="0"
                            {{ (old('app_scalable') !== null && old('app_scalable') == '0') || $settings->app_scalable === '0' ? 'selected' : '' }}>
                            {{ __('غیرفعال') }}
                        </option>
                        <option value="1"
                            {{ (old('app_scalable') !== null && old('app_scalable') == '1') || $settings->app_scalable === '1' ? 'selected' : '' }}>
                            {{ __('فعال') }}
                        </option>
                    </x-select>
                    <x-input-error :messages="$errors->get('app_scalable')" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button class="justify-end">
                    {{ __('آپدیت') }}
                </x-primary-button>
            </div>
        </form>
    </x-card>

    <div data-modal-target="social-modal" data-modal-toggle="social-modal" id="effect-area"
        class="mt-4 block md:hidden relative text-gray-500 dark:text-gray-600 text-center text-xs mb-0 cursor-pointer">
        <div class="relative text-center inline-flex">
            <span>✨</span>
            <span class="font-bold mx-1">Armin</span>
            <span>Crafted with caffeine by</span>
        </div>
        <p class="text-gray-500 dark:text-gray-600 text-center text-xs ltr">
            {{ config('app.version') }}
        </p>
    </div>

    @if (session('status') === 'settings-updated')
        <x-toast x-data="{ show: true }" x-show="show" x-transition x-init="$el.classList.add('toast-transition-in');
        $el.classList.remove('hidden');
        setTimeout(() => {
            $el.classList.remove('toast-transition-in');
            $el.classList.add('toast-transition-out');
            show = false;
        }, 5000)" class="hidden"
            icon='<svg class="w-5 h-5 text-text" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round"d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>'
            message="{{ __('تنظیمات با موفقیت آپدیت شد') }}" />
    @elseif (session('status') === 'settings-not-updated')
        <x-toast x-data="{ show: true }" x-show="show" x-transition x-init="$el.classList.add('toast-transition-in');
        $el.classList.remove('hidden');
        setTimeout(() => {
            $el.classList.remove('toast-transition-in');
            $el.classList.add('toast-transition-out');
            show = false;
        }, 5000)"
            class="hidden !bg-red-500 !divide-gray-200 text-white"
            icon='<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round"d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>'
            message="{{ __('خطا در آپدیت تنظیمات') }}" />
    @endif
</x-app-layout>
