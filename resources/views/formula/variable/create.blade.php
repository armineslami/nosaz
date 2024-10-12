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
                        <span class="text-primary text-bold">
                            {{ __('ایجاد') }}
                        </span>
                        {{ __('کنید') }}
                    </p>
                </div>
                @if(!empty($variables))
                    <div id="variablesContainer"  class="flex gap-2">
                        @foreach($variables as $variable)
                            <div class="flex justify-between items-center bg-primary py-1.5 px-2.5 min-w-16 rounded-md text-text text-sm cursor-default">
                                <p class="pe-4">{{ $variable->name }}</p>
                                <div class="cursor-pointer deleteButton" data-id="{{ $variable->id }}">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div id="spinner-{{$variable->id}}" role="status" class="hidden">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-accent" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
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
                    const spinner = document.getElementById(`spinner-${variableId}`);
                    if (spinner.classList.contains('hidden')) {
                        this.classList.add('hidden');
                        spinner.classList.remove('hidden');
                        deleteVariable(variableId)
                            .then((deleted) => {
                                if (deleted) {
                                    parent.remove();
                                    showEmptyStateIfThereIsNoVariablesLeft();
                                }
                            })
                            .finally(() => {
                                this.classList.remove('hidden');
                                spinner.classList.add('hidden');
                            });
                    }
                });
            });

            async function deleteVariable(id) {
                return axios.delete(`/formula/variable/${id}`)
                    .then(response => {
                        const deleted = response.data.deleted;
                        return !!(deleted && deleted === true);
                    })
                    .catch(error => {
                        // throw error;
                        return false;
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
