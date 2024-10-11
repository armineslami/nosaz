<x-app-layout>
    <div>
        <p class="text-text text-lg font-bold mb-2">{{ __('ساخت فرمول‌') }}</p>
        <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
            {{ __('برای محاسبه سود و هزینه پروژه‌های خود می‌توانید روش محاسباتی خود را ساخته و از آن استفاده کنید.') }}
        </p>
        <x-card>
            <form id="formulaForm" method="POST" action="{{ route('formula.store') }}">
                @csrf
                <div class="flex justify-end mb-2">
                    <x-primary-button>
                        <span id="formulaFormSubmitButtonLabel">{{ __('تایید فرمول') }}</span>
                        <div id="formulaFormSubmitButtonSpinner" role="status" class="hidden">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-accent" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </x-primary-button>
                </div>

                <x-input-label for="formulaName" :value="__('نام فرمول')" />

                <x-text-input id="formulaName" class="block my-4 w-full xl:w-1/2"
                              placeholder="{{ __('یک نام دلخواه برای فرمول خود انتخاب کنید') }}"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required />

                {{--<x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
                <p id="formulaNameError" class="text-xs text-red-600 dark:text-red-400 space-y-1 mt-2"></p>

                <label class="block mt-2 mb-2 text-sm text-text">{{ __('فرمول') }}</label>

                <!-- Formula Building Area (contenteditable) -->
                <div id="formulaBuilder" contenteditable="true" dir="ltr" spellcheck="false" class="formula-builder !ltr leading-10 min-h-24 p-2.5 w-full text-sm text-text bg-white rounded-md shadow-sm outline-none border-2 border-gray-300 dark:border-gray-700 focus:ring-accent focus:border-accent dark:bg-gray-800">
                </div>

                {{--<x-input-error :messages="$errors->get('formula')" class="mt-2"/>--}}
                <p id="formulaBuilderError" class="text-xs text-red-600 dark:text-red-400 space-y-1 mt-2"></p>

{{--                <textarea id="formulaBuilderTextArea" name="formula" class="hidden"></textarea>--}}
            </form>

            @if(count($variables) === 0)
                <div class="mt-6 md:mt-8 text-center">
                    <p class="text-text text-sm font-bold mb-2">{{ __('متغیری وجود ندارد') }}</p>
                    <p class="block md:hidden text-text-600 dark:text-gray-400 text-xs justify-center">
                        {{ __('متغیرهای خود را از طریق گزینه ') }}
                        <a href="{{ route('formula.variable.create') }}" class="text-primary text-bold">
                            {{ __('متغیر جدید') }}
                        </a>
                        {{ __('بسازید') }}
                    </p>
                    <p class="hidden md:block text-text-600 dark:text-gray-400 text-xs justify-center">
                        {{ __('متغیرهای خود را از طریق بخش ') }}
                        <a href="{{ route('formula.variable.create') }}" class="text-primary text-bold">
                            {{ __('متغیرها') }}
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
                        <p class="w-full text-center">{{ __('برچسب جدید') }}</p>
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
                            {{ __('زمانی که می‌خواهید نتیجه یک عملیات ریاضی را ذخیره کنید کافیست از ') }}
                            <span class="bg-background-100 border border-primary rounded-md text-text px-3 py-1">{{ '=' }}</span>
                            {{ __(' و به دنبال آن یک ') }}
                            <span class="text-white bg-accent px-1.5 py-1 rounded-md">{{ __('برچسب') }}</span>
                            {{ __(' برای ذخیره سازی استفاده کنید. این برچسب‌ها اطلاعاتی هستند که می‌خواهید محاسبه شده و نمایش داده شوند.') }}
                        </li>
                        <li>{{ __('در زمان محاسبه پروژه تمامی متغیرها به شما نمایش داده می‌شوند تا مقادیر آن‌ها را وارد کنید و سپس نتیجه محاسبه برای هر یک از برچسب‌ها نمایش داده می‌شود.') }}</li>
                        <li>{{ __('به صورت خودکار هر عبارت ریاضی پس از علامت = و برچسب، به پایان می‌رسد.') }}</li>
                        <li>{{ __('نمونه‌ای از فرمول:') }}</li>
                    </ul>

                    @include('formula.default-formula')
                </div>
            @endif
        </x-card>

        @include('formula.storage-name-modal')

        <x-toast
            id="successToast"
            class="hidden"
            icon='<svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
            message="{{ __('فرمول با موفقیت آپدیت شد') }}"
        />

        <x-toast
            id="failToast"
            class="hidden !bg-red-500 !text-white"
            icon='<svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
            message="{{ __('خطا در آپدیت فرمول') }}"
        />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formulaForm = document.getElementById('formulaForm');
            // const formulaBuilderTextArea = document.getElementById('formulaBuilderTextArea');
            const formulaBuilder = document.getElementById('formulaBuilder');
            let savedRange = null; // Save cursor position (range)
            let modal = null;
            let builderContentShadow = ''; // To be compared with formula builder content text
            let formulaPayload = '';
            let formulaPayloadShadow = [];


            /**
             * Before submitting the form, the content of formulaPayload is set to hidden textarea
             * and then this text area is submitted with the form.
             */
            formulaForm.onsubmit = function (e) {
                e.preventDefault();
                // formulaBuilderTextArea.value = formulaPayload;
                submitFormulaForm(formulaPayload);
            }

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
                        // insertVariable(formulaBuilder, storageName, null, true, false);
                        createStorageVariable(storageName)
                    }
                } catch (e) {}
            }

            function createStorageVariable(name) {
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

            function submitFormulaForm(formula) {
                const formulaNameElement = document.getElementById('formulaName');
                const formulaNameErrorLabel = document.getElementById('formulaNameError');
                const formulaBuilderErrorLabel = document.getElementById('formulaBuilderError');
                const buttonLabel = document.getElementById('formulaFormSubmitButtonLabel');
                const buttonSpinner = document.getElementById('formulaFormSubmitButtonSpinner');

                // Don't send another request if one is already sent
                if (buttonLabel.classList.contains('hidden')) return;

                formulaNameErrorLabel.innerText = '';
                formulaBuilderErrorLabel.innerText = '';
                buttonLabel.classList.add('hidden');
                buttonSpinner.classList.remove('hidden');

                axios.post("/formula", {name:formulaNameElement.value, formula})
                    .then(response => {
                        // console.log(response);
                        if (response && response.status === 200) {
                            if (response.data.stored) {
                                showToastById('successToast');
                                clearFormulaForm();
                            }
                        }
                    })
                    .catch(error => {
                        // console.log(error);
                        if (error && error.response) {
                            const response = error.response;
                            if (response.status === 422) {
                                if (response.data.errors.name) {
                                    formulaNameErrorLabel.innerText = response.data.errors.name[0] ?? response.data.message;
                                }
                                if (response.data.errors.formula) {
                                    formulaBuilderErrorLabel.innerText = response.data.errors.formula[0] ?? response.data.message;
                                }
                            }
                            else {
                                showToastById('failToast');
                            }
                        }
                    })
                    .finally( () => {
                        buttonLabel.classList.remove('hidden');
                        buttonSpinner.classList.add('hidden');
                    });
            }

            function showToastById(id) {
                const toast = document.getElementById(id);

                toast.classList.add('toast-transition-in');
                toast.classList.remove('hidden');

                setTimeout(() => {
                    toast.classList.remove('toast-transition-in');
                    toast.classList.add('toast-transition-out');
                    setTimeout(() => {
                        toast.classList.add('hidden');
                        toast.classList.remove('toast-transition-out');
                    }, 1000);
                }, 5000);
            }

            function clearFormulaForm() {
                const formulaNameElement = document.getElementById('formulaName');
                const formulaNameErrorLabel = document.getElementById('formulaNameError');
                const formulaBuilderErrorLabel = document.getElementById('formulaBuilderError');
                const storageArea = document.getElementById('storageArea');

                formulaNameElement.value = '';
                formulaNameErrorLabel.innerText = '';

                formulaBuilder.textContent = '';
                formulaBuilderErrorLabel.innerText = '';

                builderContentShadow = '';
                formulaPayload = '';
                formulaPayloadShadow = [];

                storageArea.innerHTML = '';
            }
        });
    </script>
</x-app-layout>
