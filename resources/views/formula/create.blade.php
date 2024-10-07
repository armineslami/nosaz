<x-app-layout>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('ساخت فرمول‌') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('برای محاسبه سود و هزینه پروژه‌های خود می‌توانید روش محاسباتی خود را ساخته و از آن استفاده کنید.') }}
        </p>
        <x-card>
            <div class="flex justify-end mb-2">
                <a href="{{ route('formula.variable.create') }}">
                    <x-secondary-button class="inline-block md:hidden">
                        {{ __('متغیر جدید') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('تایید فرمول') }}
                    </x-primary-button>
                </a>
            </div>
            <form method="POST" action="{{ route('formula.store') }}">
                @csrf
                <label class="block mb-2 text-sm text-text">{{ __('بدنه فرمول') }}</label>

                <!-- Formula Building Area (contenteditable) -->
                <div  id="formulaBuilder" contenteditable="true" dir="ltr" spellcheck="false" class="formula-builder !ltr leading-10 min-h-24 p-2.5 w-full text-sm text-text bg-gray-50 rounded-md shadow-sm outline-none border-2 border-gray-300 dark:border-gray-700 focus:ring-accent focus:border-accent dark:bg-gray-800"></div>
            </form>

            @if(empty($variables))
                <div class="mt:4 md:mt-8 text-center">
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
                <!-- Operation Buttons -->
                <div id="operationButtons" class="flex flex-wrap mt-2 md:mt-4">
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="+">+</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="-">-</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="/">/</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="*">*</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="^">^</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="%">%</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="=">=</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation=")">(</button>
                    <button class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-4 py-2 cursor-pointer" data-operation="(">)</button>
                </div>

                <!-- Variables -->
                <div id="variablesArea" class="flex flex-wrap gap-2 mt-2 md:mt-4">
                    @foreach($variables as $variable)
                        <div data-name="{{ $variable->name }}" data-id="{{ $variable->id }}" class="clickableVariable secondary-button shadow-md bg-primary py-2 px-3 min-w-12 rounded-md text-text text-sm cursor-pointer">
                            <p class="w-full text-center">{{ $variable->name }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-wrap gap-2 mt-2 md:mt-4">
                    <div
                        data-modal-target="storage-name-modal" data-modal-toggle="storage-name-modal"
                        data-name="storage"
                        class="clickableVariable secondary-button shadow-md bg-accent py-2 px-3 min-w-12 rounded-md text-white text-sm cursor-pointer">
                        <p class="w-full text-center">{{ __('ذخیره ‌ساز جدید') }}</p>
                    </div>
                    <div id="storageArea" class="flex flex-wrap gap-2"></div>
                </div>

                <div>
                    <p class="text-text text-sm font-bold mt-4 md:mt-8 mb-2">{{ __('راهنمایی') }}</p>
                    <p class="text-text-600 dark:text-gray-400 text-sm">
                        {{ __('برای نوشتن فرمول موارد زیر را رعایت کنید:') }}
                    </p>

                    <ul class="mt-4 p-4 text-text text-xs space-y-1 list-disc leading-6 lg:leading-5">
                        <li>{{ __('تنها مجاز به استفاده از متغیرها، عملگرهای ریاضی و اعداد هستید. استفاده از هر کاراکتر دیگری منجر به محاسبه اشتباه می‌گردد.') }}</li>
                        <li>{{ __('می‌توانید فرمول خود را در چند خط جدا بنویسید.') }}</li>
                        <li>{{ __('برای اضافه کردن هریک از متغیرها و یا عملگرها کافیست روی آن ضربه بزنید.') }}</li>
                        <li>{{ __('استفاده از دو متغیر یا عملگر پشت سر هم، مجاز نمی‌باشد.') }}</li>
                        <li>
                            {{ 'زمانی که می‌خواهید نتیجه یک عملیات ریاضی را ذخیره کنید کافیست از ' }}
                            <span class="bg-background-100 border border-primary rounded-md text-text px-3 py-1">{{ '=' }}</span>
                            {{ ' و به دنبال آن یک ' }}
                            <span class="text-white bg-accent px-1.5 py-1 rounded-md">{{ 'ذخیره ساز' }}</span>
                            {{ ' برای ذخیره سازی استفاده کنید.' }}
                        </li>
                        <li>{{ __('به صورت خودکار هر عبارت ریاضی پس از علامت = و ذخیره ساز، به پایان می‌رسد.') }}</li>
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
            @endif
        </x-card>

        @include('formula.storage-name-modal')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formulaBuilder = document.getElementById('formulaBuilder');
            let savedRange = null; // Save cursor position (range)
            let modal = null;
            let builderContentShadow = ''; // To be compared with formula builder content text
            let formulaPayload = '';
            let formulaPayloadShadow = [];

            // Save the current cursor position in the contenteditable area
            formulaBuilder.addEventListener('mouseup', saveSelection);
            formulaBuilder.addEventListener('keydown', onFormulaBuilderKeyDown);
            formulaBuilder.addEventListener('keyup', saveSelection);
            formulaBuilder.addEventListener('input', onFormulaBuilderInput);

            function saveSelection(disableTextSelection = true) {
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    savedRange = selection.getRangeAt(0);
                    if (disableTextSelection && savedRange.endOffset - savedRange.startOffset > 1) {
                        selection.removeAllRanges();
                        moveCursorToEnd(formulaBuilder);
                    }
                }
            }

            // Set onClick for operations
            const operationButtons = document.querySelectorAll('.operationBtn');
            operationButtons.forEach(function (operation) {
                operation.addEventListener('click', function (e) {
                    e.preventDefault();
                    const operation = this.getAttribute('data-operation');
                    insertVariable(formulaBuilder, operation, null, false, true);
                });
            });

            // Set onClick for variables
            const clickableVariables = document.querySelectorAll('.clickableVariable');
            clickableVariables.forEach(function(variable) {
                variable.addEventListener('click', function(e) {
                    e.preventDefault();
                    const variableName  = this.getAttribute('data-name');
                    const variableId    = this.getAttribute('data-id');
                    if (variableName === 'storage') {
                        showStorageNameModal();
                    }
                    else {
                        insertVariable(formulaBuilder, variableName, variableId);
                    }
                });
            });

            // Set key down for modal input
            const storageNameInput = document.getElementById('storage-name');
            storageNameInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitStorageNameModal();
                }
            });

            // Set onClick for modal cancel button
            const storageNameModalCancelButton = document.getElementById('storage-name-modal-cancel-button');
            storageNameModalCancelButton.addEventListener('click', function (e) {
                e.preventDefault();
                try {
                    modal.hide();
                }
                catch (e) {}
            });

            // Set onClick for modal confirm button
            const storageNameModalConfirmButton = document.getElementById('storage-name-modal-confirm-button');
            storageNameModalConfirmButton.addEventListener('click', function (e) {
                submitStorageNameModal();
            });

            // Insert data into contenteditable at the saved cursor position
            function insertVariable(builder, data, id = null, isStorage = false, isRawText = false) {
                let dataToInsert;

                if (!isRawText) {
                    const span = document.createElement('span');
                    span.className = isStorage ? 'formula-storage-variable' : 'formula-variable';
                    span.innerText = data;
                    span.setAttribute('contenteditable', 'false'); // Make variable non-editable
                    span.setAttribute('dir', 'ltr');
                    dataToInsert = span;
                }
                else {
                    dataToInsert = document.createTextNode(data);
                }

                // Check if we have a saved cursor position
                if (savedRange) {
                    const selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(savedRange); // Restore the saved range

                    const range = selection.getRangeAt(0);
                    range.deleteContents(); // Remove any selected text
                    range.insertNode(dataToInsert); // Insert variable at saved position

                    // Move cursor after inserted variable
                    range.setStartAfter(dataToInsert);
                    range.setEndAfter(dataToInsert);
                    selection.removeAllRanges();
                    selection.addRange(range); // Set updated cursor range
                } else {
                    // If no valid selection, append to the end of contenteditable
                    builder.appendChild(dataToInsert);
                }

                builder.focus(); // Refocus on the contenteditable area
                // moveCursorToEnd(builder);
                moveCursorForward(builder, dataToInsert)

                /**
                 * Send raw text as it is, but for storage variables send them wrapped between <>
                 * and for variables wrap their ids between two #
                 */
                updateFormula(
                    isRawText ? data : (isStorage ? '<'+data+'>' : '#'+id+'#'),
                    data.length,
                    false
                );
            }

            function moveCursorToEnd(contentEditableElement)
            {
                let range,selection;
                try {
                    if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
                    {
                        range = document.createRange();//Create a range (a range is a like the selection but invisible)
                        range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
                        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
                        selection = window.getSelection();//get the selection object (allows you to change selection)
                        selection.removeAllRanges();//remove any selections already made
                        selection.addRange(range);//make the range you have just created the visible selection
                    }
                    else if(document.selection)//IE 8 and lower
                    {
                        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
                        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
                        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
                        range.select();//Select the range (make it the visible selection
                    }
                }
                catch (e) {}
            }

            function moveCursorForward(contentEditableElement, node)
            {
                let range,selection;
                try {
                    if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
                    {
                        range = document.createRange();//Create a range (a range is a like the selection but invisible)
                        range.selectNode(node);//Select the entire contents of the element with the range
                        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
                        selection = window.getSelection();//get the selection object (allows you to change selection)
                        selection.removeAllRanges();//remove any selections already made
                        selection.addRange(range);//make the range you have just created the visible selection
                    }
                    else if(document.selection)//IE 8 and lower
                    {
                        range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
                        range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
                        range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
                        range.select();//Select the range (make it the visible selection
                    }
                }
                catch (e) {}
            }

            function showStorageNameModal()
            {
                const modalElement = document.getElementById('storage-name-modal');
                const options = {
                    closable: true,
                    onHide: () => {
                        // console.log('modal is hidden');
                    },
                    onShow: () => {
                        // console.log('modal is shown');
                    },
                    onToggle: () => {
                        // console.log('modal has been toggled');
                    },
                };

                modal = new Modal(modalElement, options);
                modal.show();

                const modalCloseButton = document.getElementById('storage-name-modal-close-button');
                modalCloseButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.hide();
                });
            }

            function submitStorageNameModal() {
                const storageNameInput = document.getElementById('storage-name');
                try {
                    if (storageNameInput.value.trim() !== '') {
                        const storageName = storageNameInput.value;
                        modal.hide();
                        storageNameInput.value = '';
                        insertVariable(formulaBuilder, storageName, null, true, false);
                        createDraggableStorageVariable(storageName)
                    }
                } catch (e) {}
            }

            function createDraggableStorageVariable(name) {
                const storageContainer = document.getElementById('storageArea');
                const span = document.createElement('span');
                span.className = 'formula-storage-variable draggableVariable';
                span.innerText = name;
                span.setAttribute('contenteditable', 'false'); // Make variable non-editable
                span.setAttribute('dir', 'ltr');
                span.setAttribute('data-name', name);
                storageContainer.append(span);

                span.addEventListener('click', function (e) {
                    e.preventDefault();
                    insertVariable(formulaBuilder, name, null, true, false);
                });
            }

            function onFormulaBuilderKeyDown(e) {
                const key = e.key;

                const validKeys = [
                    '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
                    '(', ')', '=', '%', '^', '*', '/', '-', '+',
                    'Backspace', 'Meta', 'Control', 'Alt', 'Shift', 'Enter',
                    'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown'
                ];

                if (!validKeys.includes(key)) {
                    e.preventDefault();
                }
            }

            function onFormulaBuilderInput(e) {
                console.log('Data', e);
                console.log('payload', formulaPayload);
                console.log('text content', formulaBuilder.textContent)
                if (e.inputType === 'deleteContentBackward') {
                    console.log("RANGE", savedRange.endOffset, savedRange.startOffset)
                    updateFormula(null, 0, true);
                }
                else if (e.data !== null) {
                    updateFormula(e.data);
                }

                saveSelection();
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

                    // Create a string from the array
                    formulaPayload = formulaArray.join('');
                }

                console.log('formulaPayload:', formulaPayload);
                console.log('formulaPayloadShadow:', formulaPayloadShadow);
                console.log('--------------------------');
            }

            function breakStringIntoArray(str) {
                const result = [];
                let temp = '';
                let isHashSequence = false;
                let isAngleBracketSequence = false;

                for (let i = 0; i < str.length; i++) {
                    let char = str[i];

                    if (char === '#') {
                        // Start or end of hash sequence
                        if (isHashSequence) {
                            temp += char; // Close sequence
                            result.push(temp);
                            temp = '';
                            isHashSequence = false;
                        } else {
                            if (temp) result.push(temp);
                            temp = char; // Start sequence
                            isHashSequence = true;
                        }
                    } else if (char === '<') {
                        // Start of angle bracket sequence
                        if (temp) result.push(temp);
                        temp = char;
                        isAngleBracketSequence = true;
                    } else if (char === '>' && isAngleBracketSequence) {
                        // End of angle bracket sequence
                        temp += char;
                        result.push(temp);
                        temp = '';
                        isAngleBracketSequence = false;
                    } else {
                        temp += char;

                        if (!isHashSequence && !isAngleBracketSequence) {
                            // Normal character, just push to result
                            result.push(temp);
                            temp = '';
                        }
                    }
                }

                if (temp) {
                    result.push(temp); // Push remaining temp
                }

                return result;
            }
        });
    </script>
</x-app-layout>
