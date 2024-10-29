<x-modal name="import-formula" :show="isset($sharedFormula)" focusable>
    <div class="p-6">
        <div class="mb-6">
            <p class="text-text text-lg font-bold mb-2">{{ __('بارگذاری فرمول') }}</p>
            <p class="text-text-600 dark:text-gray-300 text-sm justify-center">
                {{ __('آیا از بارگذاری فرمول زیر اطمینان دارید؟ تمامی اطلاعات این فرمول شامل متغیرها و برچسب‌ها برای حساب کاربری شما ایجاد خواهد شد.') }}
            </p>
        </div>

        <div class="flex flex-wrap gap-4 items-center mb-2">
            <x-label-darken-text class="w-[fit-content] !truncate">
                {{ __('نام') }}
            </x-label-darken-text>
            <div class="grow h-0 border-b border-dashed border-b-slate-500">
            </div>
            <div class="w-[fit-content] text-text">
                {{ $sharedFormula->name }}
            </div>
        </div>
        <div class="flex flex-wrap gap-4 items-center mb-2"">
            <x-label-darken-text class="w-[fit-content] !truncate">
                {{ __('سازنده') }}
            </x-label-darken-text>
            <div class="grow h-0 border-b border-dashed border-b-slate-500">
            </div>
            <div class="w-[fit-content] text-text">
                {{ $sharedFormula->user->name }}
            </div>
        </div>

        <form method="post" action="{{ route('formula.import') }}" class="mt-12 flex justify-end">
            @csrf
            @method('post')

            <input hidden name="id" value="{{ $sharedFormula->id }}" />

            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('انصراف') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('تایید') }}
            </x-primary-button>
        </form>
    </div>
</x-modal>
