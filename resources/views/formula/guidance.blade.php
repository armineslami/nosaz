<div>
    <p class="text-text text-sm font-bold mt-4 md:mt-8 mb-2">{{ __('راهنمایی') }}</p>
    <p class="text-text-600 dark:text-gray-400 text-sm">
        {{ __('برای نوشتن فرمول موارد زیر را رعایت کنید:') }}
    </p>

    <ul class="mt-4 p-4 text-text text-xs space-y-1 list-disc leading-6 lg:leading-5">
        <li>{{ __('تنها مجاز به استفاده از متغیرها، عملگرهای ریاضی و اعداد هستید. استفاده از هر کاراکتر دیگری منجر به محاسبه اشتباه می‌گردد.') }}
        </li>
        <li>{{ __('می‌توانید فرمول خود را در چند خط جدا بنویسید.') }}</li>
        <li>{{ __('برای اضافه کردن هریک از متغیرها و یا عملگرها کافیست روی آن ضربه بزنید.') }}</li>
        <li>{{ __('استفاده از دو متغیر یا عملگر پشت سر هم، مجاز نمی‌باشد.') }}</li>
        <li>
            {{ __('زمانی که می‌خواهید نتیجه یک عملیات ریاضی را ذخیره کنید کافیست از ') }}
            <span
                class="bg-background-100 border border-primary rounded-md text-text px-3 py-1">{{ '=' }}</span>
            {{ __(' و به دنبال آن یک ') }}
            <span class="text-white bg-accent px-1.5 py-1 rounded-md">{{ __('برچسب') }}</span>
            {{ __(' برای ذخیره سازی استفاده کنید. این برچسب‌ها اطلاعاتی هستند که می‌خواهید محاسبه شده و نمایش داده شوند.') }}
        </li>
        <li>{{ __('در زمان محاسبه پروژه تمامی متغیرها به شما نمایش داده می‌شوند تا مقادیر آن‌ها را وارد کنید و سپس نتیجه محاسبه برای هر یک از برچسب‌ها نمایش داده می‌شود.') }}
        </li>
        <li>{{ __('به صورت خودکار هر عبارت ریاضی پس از علامت = و برچسب، به پایان می‌رسد.') }}</li>
        <li>{{ __('نمونه‌ای از فرمول:') }}</li>
    </ul>

    <div class="ltr mt-4">
        <div class="flex items-center gap-1 text-sm">
            <p class="text-text">(</p>
            <div class="shadow-md bg-primary py-1 px-1.5 rounded-md text-text text-xs select-none">
                {{ __('متراژ زمین') }}
            </div>
            <p class="text-text"> * 60 ) / 100 = </p>
            <div class="shadow-md bg-accent py-1 px-1.5 rounded-md text-white text-xs select-none">
                {{ __('متراژ هر سقف') }}
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm mt-2">
            <div class="shadow-md bg-accent py-1 px-1.5 rounded-md text-white text-xs select-none">
                {{ __('متراژ هر سقف') }}
            </div>
            <p class="text-text"> * </p>
            <div class="shadow-md bg-primary py-1 px-1.5 rounded-md text-text text-xs select-none">
                {{ __('تعداد سقف') }}
            </div>
            <p class="text-text"> = </p>
            <div class="shadow-md bg-accent py-1 px-1.5 rounded-md text-white text-xs select-none">
                {{ __('متراژ کل طبقات') }}
            </div>
        </div>
        <div class="flex items-center gap-1 text-sm mt-2">
            <div class="shadow-md bg-accent py-1 px-1.5 rounded-md text-white text-xs select-none">
                {{ __('متراژ کل طبقات') }}
            </div>
            <p class="text-text"> * </p>
            <div class="shadow-md bg-primary py-1 px-1.5 rounded-md text-text text-xs select-none">
                {{ __('قیمت ساخت هر متر') }}
            </div>
            <p class="text-text"> = </p>
            <div class="shadow-md bg-primary py-1 px-1.5 rounded-md text-text text-xs select-none">
                {{ __('هزینه ساخت') }}
            </div>
        </div>
    </div>
</div>
