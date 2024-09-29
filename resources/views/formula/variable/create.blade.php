<x-app-layout>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('ایجاد متغیر') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('متغیرهای مورد نیاز در فرمول خود را در این بخش ایجاد کنید. سپس از این متغیرها در بخش ساخت فرمول استفاده کرده و در هنگام محاسبه پروژه، مقادیر آن‌ها را وارد کنید.') }}
        </p>
        <x-card>
            <form method="POST" action="{{ route('formula.variable.store') }}">
                @csrf
                <x-input-label for="name" :value="__('نام متغیر')" />
                <x-text-input id="name" class="block my-4 w-full"
                              placeholder="{{ __('مانند: درصد مشارکت، هزینه ساخت، ...') }}"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <div class="flex justify-end mt-2">
                    <x-primary-button>
                        {{ __('ایجاد') }}
                    </x-primary-button>
                </div>
            </form>
        </x-card>

        <div class="mt-6">
            <p class="text-text text-lg font-bold mb-2">{{ __('متغیرها') }}</p>
            <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
                {{ __('متغیرهای ساخته شده را مشاهده و یا حذف کنید.') }}
            </p>

            <x-card id="variablesCard" class="min-h-28 {{ empty($variables) ? 'flex justify-center' : ''}}">
                <div id="variablesEmptyState" class="{{ empty($variables) ? 'flex' : 'hidden'}} items-center">
                    <p class="text-text-600 dark:text-gray-400 text-xs justify-center">
                        {{ __('متغیری نساخته‌اید! یک متغیر جدید ') }}
                        <a href="{{ route('formula.variable.create') }}" class="text-primary text-bold">
                            {{ __('ایجاد') }}
                        </a>
                        {{ __('کنید') }}
                    </p>
                </div>
                @if(!empty($variables))
                    <div id="variablesContainer"  class="flex gap-4">
                        @foreach($variables as $variable)
                            <div class="flex justify-between items-center bg-secondary py-2 px-3 min-w-24 rounded-md text-text text-sm cursor-default">
                                <p class="pe-4">{{ $variable->name }}</p>
                                <div class="cursor-pointer deleteButton" data-id="{{ $variable->id }}">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
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
                    const variableId = this.getAttribute('data-id');
                    const parent = this.parentElement;
                    deleteVariable(variableId, parent);
                });
            });

            function deleteVariable(id, parentElement) {
                axios.delete(`/formula/variable/${id}`)
                    .then(response => {
                        const deleted = response.data.deleted;
                        if (deleted) {
                            parentElement.remove();
                            showEmptyStateIfThereIsNoVariablesLeft();
                        }
                    })
                    .catch(error => {
                        // console.error('Error deleting the resource:', error);
                    });
            }

            function showEmptyStateIfThereIsNoVariablesLeft() {
                const variablesContainer = document.getElementById('variablesContainer');
                if (variablesContainer.children.length === 0) {
                    const variablesEmptyState = document.getElementById('variablesEmptyState');
                    variablesEmptyState.classList.remove('hidden');
                    variablesEmptyState.classList.add('flex')

                    const variablesCard = document.getElementById('variablesCard');
                    variablesCard.classList.add('flex');
                    variablesCard.classList.add('justify-center');
                }
            }
        });
    </script>
</x-app-layout>
