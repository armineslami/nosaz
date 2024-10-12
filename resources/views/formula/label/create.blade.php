<x-app-layout>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('ایجاد برچسب') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('برچسب‌ها علاوه بر اینکه اجازه ذخیره‌سازی عملیات ریاضی در فرمول را به شما میدهند، امکان دسته بندی اطلاعات محاسبه شده‌ی پروژه را نیز فراهم می‌کنند.') }}
        </p>
        <x-card>
            <form
                x-data="{
                selectedType: '', showCategory: false, optionsCount: 0, labelName: '',
                    initialize() {
                        this.optionsCount = this.$refs.labelCategory ? this.$refs.labelCategory.options.length : 0;
                        this.showCategory = false;
                        this.selectedType = '';
                        this.labelName = '';
                    }
                }"
                x-init="initialize()"
                method="POST"
                action="{{ route('formula.label.store') }}">
                @csrf

                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-12 md:col-span-6">
                        <x-input-label for="name" :value="__('نام برچسب')" />
                        <x-text-input id="name" class="w-full my-4"
                                      placeholder="{{ __('مانند: هزینه ساخت، سود نهایی، ...') }}"
                                      type="text"
                                      name="name"
                                      :value="old('name')"
                                      required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <x-input-label for="type" :value="__('نوع برچسب')" />
                        <x-select name="type" class="w-full my-4" x-model="selectedType" @change="showCategory = (selectedType === '0')">
                            <option value="1" {{ !old('type') || old('type') === '1' ? 'selected' : '' }}>{{ __('سردسته') }}</option>
                            @if (!empty($labels))
                                <option id="child-type-option" value="0" {{ old('type') === '1' ? 'selected' : '' }}>{{ __('زیر مجموعه') }}</option>
                            @endif
                        </x-select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                   <template x-if="showCategory === true">
                       <div class="col-span-12 md:col-span-6">
                           <x-input-label for="parent" :value="__('دسته بندی')" />
                           <x-select id="label-category-select" name="parent" class="w-full my-4" x-ref="labelCategory">
                               @foreach($labels as $label)
                                   @if($label->is_parent)
                                       <option value="{{ $label->id }}" {{ (!old('parent') && $loop->index === 0) || old('parent') === $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
                                   @endif
                               @endforeach
                           </x-select>
                           <x-input-error :messages="$errors->get('parent')" class="mt-2" />
                       </div>
                   </template>
                </div>

                <div class="flex justify-end mt-2">
                    <x-primary-button>
                        {{ __('ایجاد') }}
                    </x-primary-button>
                </div>
            </form>
        </x-card>

        <div class="mt-6">
            <p class="text-text text-lg font-bold mb-2">{{ __('برچسب‌ها') }}</p>
            <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
                {{ __('برچسب‌ها ساخته شده را مشاهده و یا حذف کنید.') }}
            </p>

            <x-card id="labelsCard" class="min-h-28 {{ empty($labels) ? 'flex justify-center' : ''}}">
                <div id="labelsEmptyState" class="{{ empty($labels) ? 'flex' : 'hidden'}} items-center">
                    <p class="text-text-600 dark:text-gray-400 text-xs justify-center">
                        {{ __('برچسبی نساخته‌اید! یک برچسب جدید ') }}
                        <span class="text-primary text-bold">
                            {{ __('ایجاد') }}
                        </span>
                        {{ __('کنید') }}
                    </p>
                </div>
                @if(!empty($labels))
                    <div id="labelsContainer"  class="flex flex-wrap gap-2">
                        @foreach($labels as $label)
                            @if($label->is_parent)
                                <div class="flex flex-row gap-2 bg-primary-800 dark:bg-primary-200 rounded-md p-1">
                                    <div data-is-parent="true" data-id="{{ $label->id }}" class="flex justify-between items-center bg-primary-500 dark:bg-primary py-2 px-3 min-w-24 rounded-md text-text text-sm cursor-default">
                                        <p class="pe-4">{{ $label->name }}</p>
                                        <div class="cursor-pointer deleteButton" data-id="{{ $label->id }}">
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                        <div id="spinner-{{$label->id}}" role="status" class="hidden">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-accent" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    @foreach($labels as $_label)
                                        @if(!$_label->is_parent && $_label->parent_id === $label->id)
                                            <div data-parent-id="{{ $label->id }}" class="flex justify-between items-center bg-primary dark:bg-primary-500 py-2 px-3 min-w-24 rounded-md text-text text-sm cursor-default">
                                                <p class="pe-4">{{ $_label->name }}</p>
                                                <div class="cursor-pointer deleteButton" data-id="{{ $_label->id }}">
                                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </div>
                                                <div id="spinner-{{$_label->id}}" role="status" class="hidden">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-accent" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                    </svg>
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </x-card>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const labelId = this.getAttribute('data-id');
                    const container = this.parentElement;
                    const spinner = document.getElementById(`spinner-${labelId}`);
                    if (spinner.classList.contains('hidden')) {
                        this.classList.add('hidden');
                        spinner.classList.remove('hidden');
                        deleteLabel(labelId)
                            .then((deleted) => {
                                if (deleted) {
                                    const isParent = container.getAttribute('data-is-parent');
                                    if (!isParent) {
                                        container.remove()
                                    }
                                    else {
                                        container.parentElement.remove()
                                    }

                                    showEmptyStateIfThereIsNoLabelLeft();

                                    window.location.reload();
                                }
                            })
                            .finally(() => {
                                this.classList.remove('hidden');
                                spinner.classList.add('hidden');
                            });
                    }
                });
            });

            async function deleteLabel(id) {
                return await axios.delete(`/formula/label/${id}`)
                    .then(response => {
                        const deleted = response.data.deleted;
                        return !!(deleted && deleted === true);
                    })
                    .catch(error => {
                        // throw error;
                        return false;
                    });
            }

            function showEmptyStateIfThereIsNoLabelLeft() {
                const labelsContainer = document.getElementById('labelsContainer');
                if (labelsContainer.children.length === 0) {
                    const labelsEmptyState = document.getElementById('labelsEmptyState');
                    labelsEmptyState.classList.remove('hidden');
                    labelsEmptyState.classList.add('flex')

                    const labelsCard = document.getElementById('labelsCard');
                    labelsCard.classList.add('flex');
                    labelsCard.classList.add('justify-center');

                    const childTypeOption = document.getElementById('child-type-option');
                    childTypeOption.remove();
                }
            }
        });
    </script>
</x-app-layout>
