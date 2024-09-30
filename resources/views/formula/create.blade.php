<x-app-layout>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('ساخت فرمول‌') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('برای محاسبه سود و هزینه پروژه‌های خود می‌توانید روش محاسباتی خود را ساخته و از آن استفاده کنید.') }}
        </p>
        <x-card>
            <div class="flex justify-end mb-2">
                <a href="{{ route('formula.variable.create') }}">
                    <x-secondary-button class="!bg-transparent !border-primary">
                        {{ __('متغیر جدید') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('تایید فرمول') }}
                    </x-primary-button>
                </a>
            </div>
            <form method="POST" action="{{ route('formula.store') }}">
                @csrf
                <label for="formulaTextarea" class="block mb-2 text-sm text-text">اطلاعات فرمول</label>
                <textarea id="formulaTextarea" rows="4" class="ltr block p-2.5 w-full text-sm text-text bg-gray-50 rounded-md shadow-sm border border-gray-300 dark:border-gray-700 focus:ring-accent focus:border-accent dark:bg-gray-900" placeholder="{{ __('فرمول خود را با استفاده از متغیر‌ها بسازید') }}"></textarea>
{{--                <div class="flex justify-end mt-4"></div>--}}
            </form>

            @if(empty($variables))
                <div class="mt-8 text-center">
                    <p class="text-text text-sm font-bold mb-2">{{ __('متغیری وجود ندارد') }}</p>
                    <p class="text-text-600 dark:text-gray-400 text-xs justify-center">
                        {{ __('متغیرهای خود را از طریق گزینه ') }}
                        <a href="{{ route('formula.variable.create') }}" class="text-primary text-bold">
                            {{ __('متغیر جدید') }}
                        </a>
                        {{ __('بسازید') }}
                    </p>
                </div>
            @else
                <div id="variables" class="flex gap-4 mt-8">
                    @foreach($variables as $variable)
                        <div data-name="{{ $variable->name }}" class="bg-secondary py-2 px-3 min-w-24 rounded-md text-text text-sm cursor-grab">
                            <p class="w-full text-center">{{ $variable->name }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-card>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('formulaTextarea');
            const element = document.getElementById('variables');
            window.Sortable.create(element, {
                sort: false,
                onEnd: function(event) {
                    // Get the variable name and insert it into the textarea
                    const variableName = event.item.getAttribute('data-name');
                    insertAtCursor(textarea, variableName);
                }});

            function insertAtCursor(textarea, text) {
                const start = textarea.selectionStart;
                const end = textarea.selectionEnd;
                const beforeText = textarea.value.substring(0, start);
                const afterText = textarea.value.substring(end);
                textarea.value = beforeText + text + afterText;
                // Move the cursor to the end of the inserted text
                textarea.selectionStart = textarea.selectionEnd = start + text.length;
                textarea.focus(); // Refocus the textarea
            }
        });
    </script>
</x-app-layout>
