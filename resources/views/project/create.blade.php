<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <p class="text-text text-lg font-bold mb-2">{{ __('محاسبه') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('پروژه‌ خود را با وارد کردن اطلاعات توسط یک فرمول محاسبه و در صورت نیاز ذخیره کنید.') }}
        </p>
        <x-card class="mt-8">
            <form method="POST" action="{{ route('project.store') }}" x-data="{ formAction: '{{ route('project.store') }}' }"
                x-bind:action="formAction">
                @csrf

                <div class="space-y-4 md:space-y-8">

                    <div>
                        <label for="formula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('فرمول') }}
                        </label>
                        <x-select class="w-full" name="formula" onchange="changeFormula(this.value)">
                            @if ($settings->app_show_default_formula === '1' || count($data->formulas->user) === 0)
                                @foreach ($data->formulas->defaults as $formula)
                                    <option value="{{ $formula->id }}"
                                        {{ (old('formula') !== null && old('formula') == $formula->id) || $formula->id == $formulaId ? 'selected' : '' }}>
                                        {{ $formula->name }}</option>
                                @endforeach
                            @endif
                            @foreach ($data->formulas->user as $formula)
                                <option value="{{ $formula->id }}"
                                    {{ (old('formula') !== null && old('formula') == $formula->id) || $formula->id == $formulaId ? 'selected' : '' }}>
                                    {{ $formula->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('formula')" class="mt-2" />
                    </div>

                    <div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 md:gap-4">
                            @foreach ($data->variables as $variable)
                                <div class="mb-4">
                                    <label for="var_{{ $variable->id }}"
                                        class="block text-sm truncate mb-2 font-medium text-gray-900 dark:text-white">
                                        {{ $variable->name }}
                                    </label>
                                    <x-text-input type="number" step="any" name="var_{{ $variable->id }}"
                                        class="w-full numeric-input" placeholder="{{ $variable->name }}"
                                        :value="old('var_' . $variable->id)">
                                    </x-text-input>
                                    <x-input-error :messages="$errors->get('var_' . $variable->id)" class="mt-2" />
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-8">
                    <x-secondary-button class="w-1/2 md:w-1/6" type="button"
                        @click.prevent="formAction = '{{ route('project.calculate') }}'; $nextTick(() => $el.closest('form').submit())">
                        {{ __('محاسبه') }}
                    </x-secondary-button>
                    <x-primary-button class="w-1/2 md:w-1/6" type="button" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'store-project')">
                        {{ __('ذخیره') }}
                    </x-primary-button>
                </div>

                <x-modal name="store-project" focusable>
                    <div class="p-6">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-text">
                                {{ __('ذخیره پروژه') }}
                            </h2>

                            <p class="mt-1 text-sm text-text-600 dark:text-gray-400">
                                {{ __('نام پروژه و در صورت نیاز، توضیحات مربوط به آن را وارد نمایید.') }}
                            </p>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('نام') }}
                                </label>
                                <x-text-input type="text" name="name" class="w-full" value="{{ old('name') }}"
                                    placeholder="{{ __('نام پروژه') }}">
                                </x-text-input>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('توضیحات') }}
                                </label>
                                <x-text-input type="text" name="description" class="w-full"
                                    value="{{ old('description') }}" placeholder="{{ __('توضیحات پروژه') }}">
                                </x-text-input>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('انصراف') }}
                            </x-secondary-button>

                            <x-primary-button class="ms-3">
                                {{ __('تایید') }}
                            </x-primary-button>
                        </div>
                    </div>
                </x-modal>
            </form>
        </x-card>
    </div>

    @if (session('status') === 'project-not-created')
        <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
        $el.classList.remove('hidden');
        setTimeout(() => {
            $el.classList.remove('toast-transition-in');
            $el.classList.add('toast-transition-out');
            show = false;
        }, 5000)"
            class="hidden !bg-red-500 !divide-gray-200 text-white"
            icon='<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round"d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>'
            message="{{ __('خطا در ایجاد پروژه') }}" />
    @elseif (session('status') === 'formula-pyload-corrupted')
        <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
        $el.classList.remove('hidden');
        setTimeout(() => {
            $el.classList.remove('toast-transition-in');
            $el.classList.add('toast-transition-out');
            show = false;
        }, 5000)"
            class="hidden !bg-red-500 !divide-gray-200 text-white"
            icon='<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round"d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>'
            message="{{ __('اطلاعات فرمول استفاده شده صحیح نمی‌باشد') }}" />
    @elseif (session('status') === 'project-calculation-failed')
        <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
        $el.classList.remove('hidden');
        setTimeout(() => {
            $el.classList.remove('toast-transition-in');
            $el.classList.add('toast-transition-out');
            show = false;
        }, 5000)"
            class="hidden !bg-red-500 !divide-gray-200 text-white"
            icon='<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round"d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>'
            message="{{ __('خطا در انجام محساسبه') }}" />
    @endif

    @if ($errors->get('name') || $errors->get('description'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.dispatchEvent(new CustomEvent('open-modal', {
                    detail: 'store-project'
                }));
            });
        </script>
    @endif

    <script>
        function changeFormula(formulaId) {
            const url = "{{ route('project.create') }}" + formulaId !== 0 ? `?formulaId=${formulaId}` : '';
            window.location.href = url; // Redirect to the new URL
        }

        document.addEventListener('DOMContentLoaded', function() {
            const numericInputs = document.querySelectorAll('.numeric-input');
            numericInputs.forEach(function(input) {
                input.addEventListener('keydown', function(e) {
                    const key = e.key;
                    const isNumberKey = key >= '0' && key <= '9';
                    const validKeys = [
                        'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'ArrowUp',
                        'ArrowDown', 'Tab', '.'
                    ];

                    // Allow Ctrl/Command key combinations
                    const isCtrlCmdCombo = (e.ctrlKey || e.metaKey) && ['a', 'c', 'v', 'x', 'z']
                        .includes(key.toLowerCase());

                    if (!isNumberKey && !validKeys.includes(key) && !isCtrlCmdCombo) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>
