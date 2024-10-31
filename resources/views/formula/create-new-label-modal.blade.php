<div id="create-new-label-modal" data-modal-target="create-new-label-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('ایجاد برچسب') }}
                </h3>
                <button id="create-new-label-modal-close-button" type="button"
                    class="text-gray-500 bg-transparent hover:text-text-900 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white focus:outline-none"
                    data-modal-hide="create-new-label-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">{{ __('بستن') }}</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div id="label-modal-x-data" class="space-y-4" x-data="{
                    selectedType: '',
                    selectedUnit: '',
                    showCategory: false,
                    optionsCount: 0,
                    labelName: '',
                    initializeLabelModal() {
                        this.optionsCount = this.$refs.labelCategory.options.length;
                        this.showCategory = false;
                        this.selectedType = '';
                        this.selectedUnit = '';
                        this.labelName = '';
                    }
                }" x-init="initializeLabelModal()"
                    @modal-open-label="initializeLabelModal()">

                    <div>
                        <label for="label-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('نام') }}
                        </label>
                        <x-text-input type="text" name="label-name" id="create-new-label-modal-label-name"
                            x-model="labelName" class="w-full" placeholder="{{ __('نام برچسب') }}" required>
                        </x-text-input>
                        <x-input-error :messages="$errors->get('label-name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="create-new-label-modal-label-type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('نوع برچسب') }}
                        </label>
                        <x-select class="w-full" id="create-new-label-modal-label-type" x-model="selectedType"
                            @change="showCategory = (selectedType === 'child')">
                            <option value="parent" selected>{{ __('سردسته') }}</option>
                            <template x-if="optionsCount > 0">
                                <option value="child">{{ __('زیر مجموعه') }}</option>
                            </template>
                        </x-select>

                        <div class="mt-4">
                            <label for="create-new-label-modal-label-unit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('واحد') }}
                            </label>
                            <x-select id="create-new-label-modal-label-unit" name="create-new-label-modal-label-unit"
                                class="w-full" x-model="selectedUnit">
                                <option value=""
                                    {{ !old('unit') || (old('unit') && old('unit') === '') ? 'selected' : '' }}>
                                    {{ __('app.none') }}</option>
                                <option value="millimeter"
                                    {{ old('unit') && old('unit') === 'millimeter' ? 'selected' : '' }}>
                                    {{ __('app.millimeter') }}</option>
                                <option value="centimeter"
                                    {{ old('unit') && old('unit') === 'centimeter' ? 'selected' : '' }}>
                                    {{ __('app.centimeter') }}</option>
                                <option value="meter" {{ old('unit') && old('unit') === 'meter' ? 'selected' : '' }}>
                                    {{ __('app.meter') }}</option>
                                <option value="milligram"
                                    {{ old('unit') && old('unit') === 'milligram' ? 'selected' : '' }}>
                                    {{ __('app.milligram') }}</option>
                                <option value="gram" {{ old('unit') && old('unit') === 'gram' ? 'selected' : '' }}>
                                    {{ __('app.gram') }}</option>
                                <option value="kilogram"
                                    {{ old('unit') && old('unit') === 'kilogram' ? 'selected' : '' }}>
                                    {{ __('app.kilogram') }}</option>
                                <option value="ton" {{ old('unit') && old('unit') === 'ton' ? 'selected' : '' }}>
                                    {{ __('app.ton') }}</option>
                                <option value="number" {{ old('unit') && old('unit') === 'number' ? 'selected' : '' }}>
                                    {{ __('app.number') }}</option>
                                <option value="percent"
                                    {{ old('unit') && old('unit') === 'percent' ? 'selected' : '' }}>
                                    {{ __('app.percent') }}</option>
                                <option value="toman" {{ old('unit') && old('unit') === 'toman' ? 'selected' : '' }}>
                                    {{ __('app.toman') }}</option>
                                <option value="rial" {{ old('unit') && old('unit') === 'rial' ? 'selected' : '' }}>
                                    {{ __('app.rial') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                        </div>

                        <div x-show="showCategory" class="mt-4">
                            <label for="create-new-label-modal-label-category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('دسته بندی') }}
                            </label>
                            <x-select class="w-full" id="create-new-label-modal-label-category" x-ref="labelCategory">
                                <option selected>{{ __('سردسته برچسب را انتخاب کنید') }}</option>
                                <!-- More options will be appended here by JS code -->
                            </x-select>
                        </div>
                    </div>

                    <div class="flex items-center py-4 ltr gap-2">
                        <x-primary-button data-modal-hide="create-new-label-modal"
                            id="create-new-label-modal-confirm-button">
                            <span id="create-new-label-modal-confirm-button-text">{{ __('تایید') }}</span>
                            <div id="create-new-label-modal-confirm-button-spinner" role="status" class="hidden">
                                <svg aria-hidden="true"
                                    class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-accent"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </x-primary-button>
                        <x-secondary-button data-modal-hide="create-new-label-modal"
                            id="create-new-label-modal-cancel-button">
                            {{ __('انصراف') }}
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
