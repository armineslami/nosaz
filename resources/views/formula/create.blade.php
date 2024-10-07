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

            function updateFormula(data, length = 1, isDeletion = false) {
                const builderContent = formulaBuilder.textContent;

                let position = null;

                // Determine the minimum length to compare both strings
                const minLength = Math.min(builderContent.length, builderContentShadow.length);
                console.log('builderContent', builderContent);
                console.log(builderContent.length, builderContentShadow.length, 'minLength', minLength);

                if (minLength === 0) {
                    position = minLength;
                }
                else {
                    // Loop through the strings to find the position where they differ
                    for (let i = 0; i <= minLength; i++) {
                        if (builderContentShadow[i] === undefined || builderContent[i] !== builderContentShadow[i]) {
                            position = i;
                            break;
                        }
                    }
                }

                console.log('Position', position);

                // Update shadow to latest content
                builderContentShadow = builderContent;

                console.warn("Deletion", isDeletion);
                if (isDeletion) {
                    if (builderContent === '') {
                        formulaPayload = '';
                        formulaPayloadShadow = [];
                    }
                    else {
                        formulaPayload = '';
                        let length = 0;
                        for (let i = 0; i < formulaPayloadShadow.length; i++) {
                            if (formulaPayloadShadow[i].position === position) {
                                console.log('i is', i, 'TO delete:', formulaPayloadShadow[i]);
                                length = formulaPayloadShadow[i].length;
                                formulaPayloadShadow.splice(i, 1);
                            }
                        }
                        for (let i = 0; i < formulaPayloadShadow.length; i++) {
                            if (formulaPayloadShadow[i].position > position) {
                                let newPosition = formulaPayloadShadow[i].position - length;
                                formulaPayloadShadow[i].position = newPosition < 0 ? 0 : newPosition;
                            }
                        }
                        for (let i = 0; i < formulaPayloadShadow.length; i++) {
                            formulaPayload += formulaPayloadShadow[i].name;
                        }
                    }
                }
                else {
                    // Break the formula into array indexes
                    const formulaArray = breakStringIntoArray(formulaPayload);
                    console.log('Array', formulaArray);

                    // Insert data at calculated position
                    formulaArray.splice(position, 0, data);

                    // Update formula payload shadow
                    formulaPayloadShadow.splice(position, 0, {name: data, position, length})
                    // for (let i = position; i < formulaPayloadShadow.length; i++) {
                    //     formulaPayloadShadow[i].position = formulaPayloadShadow[i].position;// + length;
                    // }

                    // Create a string from the array
                    formulaPayload = formulaArray.join('');
                }

                console.log('formulaPayload:', formulaPayload);
                console.log('formulaPayloadShadow:', formulaPayloadShadow);
                console.log('--------------------------');
            }

        });
    </script>
</x-app-layout>
