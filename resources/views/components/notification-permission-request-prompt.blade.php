<x-modal id="notification-permission-request" maxWidth="md" name="notification-permission-request" focusable>
    <div class="notification-permission-request px-4 py-12 md:px-12 md:py-12 flex flex-col items-center">
        <div class="flex flex-col items-center pb-8">
            <div id="notification-permission-request" class='w-[fit-content] px-2 py-2 rounded-xl mb-8'>
                <svg class="stroke-text" width="80px" height="80px" fill="none" viewBox="0 0 24 24" stroke-width="1"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
            </div>
            <p class="text-sm text-text font-bold text-center justify-center">
                {{ __('درخواست دسترسی') }}
            </p>
            <p class="text-sm text-text mt-4 text-center justify-center">
                {{ __(' نرم افزار برای ارسال اطلاع رسانی به تایید شما برای دسترسی احتیاج
                                                                                                                دارد. پس از بستن این پنجره درخواست دسترسی برای شما نمایش داده
                                                                                                                خواهد شده که در صورت تمایل به دریافت اطلاع رسانی‌ها کافیست گزینه Allow (اجازه)
                                                                                                                را انتخاب نمایید.') }}
            </p>
        </div>
        <x-primary-button class="mt-4 w-full" type="button" x-on:click="$dispatch('close')">
            {{ __('متوجه شدم') }}
        </x-primary-button>
    </div>
</x-modal>
