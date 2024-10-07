<div id="storage-name-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('انتخاب نام ذخیره‌ ساز') }}
                </h3>
                <button id="storage-name-modal-close-button" type="button" class="text-gray-500 bg-transparent hover:text-text-900 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white focus:outline-none" data-modal-hide="storage-name-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">{{ __('بستن') }}</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="space-y-4">
                    <div>
                        <label for="storage-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('نام') }}
                        </label>
                        <input type="text" name="storage-name" id="storage-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{ __('نام ذخیره ساز') }}" required />
                    </div>
                    <div class="flex items-center py-4 ltr gap-2">
                        <x-primary-button data-modal-hide="storage-name-modal" id="storage-name-modal-confirm-button">
                            {{ __('تایید') }}
                        </x-primary-button>
                        <x-secondary-button data-modal-hide="storage-name-modal" id="storage-name-modal-cancel-button">
                            {{ __('انصراف') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
