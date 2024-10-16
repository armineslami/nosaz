<x-app-layout>
    <div>
        <div>
            <p class="text-text text-lg font-bold mb-2">{{ __('آپدیت فرمول‌') }}</p>
            <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
                {{ __('اطلاعات مربوط به فرمول خود را مشاهده کرده و در صورت نیاز آن را تغییر داده و یا حذف کنید.') }}
            </p>
        </div>
        <x-card>
            <form id="formulaForm" method="POST" action="{{ route('formula.store') }}">
                @csrf

                <div class="flex justify-end mb-2 gap-2">
                    <x-secondary-button id="create-new-label-button" data-name="label">
                        <p class="w-full text-center">{{ __('برچسب جدید') }}</p>
                    </x-secondary-button>
                    <x-secondary-button id="create-new-variable-button" data-name="variable">
                        <p class="w-full text-center">{{ __('متغیر جدید') }}</p>
                    </x-secondary-button>
                </div>

                <span id="formulaId" class="hidden">{{ $formula->id }}</span>

                <x-input-label for="formulaName" :value="__('نام فرمول')" />

                <x-text-input id="formulaName" class="block my-4 w-full xl:w-1/2"
                    placeholder="{{ __('یک نام دلخواه برای فرمول خود انتخاب کنید') }}" type="text" name="name"
                    :value="$formula->name" required />

                {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
                <p id="formulaNameError" class="text-xs text-red-600 dark:text-red-400 space-y-1 mt-2"></p>

                <label class="block mt-2 mb-2 text-sm text-text">{{ __('فرمول') }}</label>

                <!-- Formula Building Area (contenteditable) -->
                <div id="formulaBuilder" contenteditable="true" dir="ltr" spellcheck="false"
                    class="formula-builder !ltr leading-10 min-h-24 p-2.5 w-full text-sm text-text bg-white rounded-md shadow-sm outline-none border-2 border-gray-300 dark:border-gray-700 focus:ring-accent focus:border-accent dark:bg-gray-800">
                </div>
                <p id="hiddenFormulaPayload" class="hidden">{{ $formula->payload }}</p>

                {{-- <x-input-error :messages="$errors->get('formula')" class="mt-2"/> --}}
                <p id="formulaBuilderError" class="text-xs text-red-600 dark:text-red-400 space-y-1 mt-2"></p>

                <div class="flex justify-end my-4">
                    <x-danger-button class="me-2" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-formula-deletion')">
                        {{ __('حذف') }}
                    </x-danger-button>
                    <x-primary-button>
                        <span id="formulaFormSubmitButtonLabel">{{ __('تایید فرمول') }}</span>
                        <div id="formulaFormSubmitButtonSpinner" role="status" class="hidden">
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
                </div>
            </form>

            @if (count($variables) === 0)
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
                <div class="flex flex-wrap mt-4 md:mt-4 justify-between gap-2 w-full">
                    <div id="operationButtons">
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="+">+</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="-">-</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="/">/</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="*">*</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="^">^</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="%">%</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation=")">(</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="(">)</button>
                        <button
                            class="secondary-button shadow-md operationBtn min-w-12 min-h-6 bg-background-100 border border-primary rounded-md text-text text-sm text-center justify-center me-2 mb-2 px-2 py-1 cursor-pointer"
                            data-operation="=">=</button>
                    </div>
                </div>

                <!-- Variables -->
                <div id="variablesArea" class="flex flex-wrap gap-2 mt-2 md:mt-4">
                    @foreach ($variables as $variable)
                        <div data-name="{{ $variable->name }}" data-id="{{ $variable->id }}" data-type="variable"
                            class="variable clickable secondary-button formula-variable text-sm min-w-16">
                            <p class="w-full text-center">{{ $variable->name }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Labels -->
                <div id="labelArea" class="flex flex-wrap gap-2 mt-4">
                    @foreach ($labels as $label)
                        @if ($label->is_parent)
                            <div class="flex flex-row flex-wrap gap-2 bg-gray-300 dark:bg-gray-800 rounded-md p-1">
                                <div data-is-parent="true" data-name="{{ $label->name }}"
                                    data-id="{{ $label->id }}" data-type="label"
                                    class="label clickable secondary-button cursor-pointer bg-accent-500 dark:bg-accent py-1 px-2 min-w-16 rounded-md text-text text-sm">
                                    <p class="w-full text-center">{{ $label->name }}</p>
                                </div>
                                @foreach ($label->children as $_label)
                                    <div data-parent-id="{{ $label->id }}" data-name="{{ $_label->name }}"
                                        data-id="{{ $_label->id }}" data-type="label"
                                        class="label clickable secondary-button bg-accent-400 dark:bg-accent-600 py-1 px-2 min-w-16 rounded-md text-text text-sm cursor-pointer">
                                        <p class="w-full text-center">{{ $_label->name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>

                @include('formula.guidance')
            @endif
        </x-card>

        @include('formula.create-new-label-modal')
        @include('formula.create-new-variable-modal');

        <x-toast id="successToast" class="hidden"
            icon='<svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
            message="{{ __('فرمول با موفقیت آپدیت شد') }}" />

        <x-toast id="failToast" class="hidden !bg-red-500 !text-white"
            icon='<svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
            message="{{ __('خطا در آپدیت فرمول') }}" />

        <x-modal name="confirm-formula-deletion" focusable>
            <form method="post" action="{{ route('formula.destroy', $formula->id) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-bold text-text">
                    {{ __('حذف فرمول') }}
                </h2>

                <p class="mt-1 text-sm text-text-600 dark:text-gray-400">
                    {{ __('تمامی پروژه‌هایی که از این فرمول استفاده کرده‌اند، توسط فرمول پیش فرض محاسبه خواهند شد. آیا از حذف این فرمول اطمینان دارید؟') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('انصراف') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('تایید') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>

        @if (session('status') === 'formula-not-deleted')
            <x-toast x-data="{ show: true }" x-show="show" x-transition x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)"
                class="hidden !bg-red-500 !divide-gray-200 !text-white" id="toast"
                icon='<svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
                message="{{ __('خطا در حذف فرمول') }}" />
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const DEBUG = true;
            const formulaForm = document.getElementById('formulaForm');
            const formulaBuilder = document.getElementById('formulaBuilder');
            let savedRange = null; // Save cursor position (range)
            let modal = null;
            let builderContentShadow = ''; // To be compared with formula builder content text
            let formulaPayload = '';
            let formulaPayloadShadow = [];

            formulaForm.onsubmit = function(e) {
                e.preventDefault();
                submitFormulaForm(formulaPayload);
            }

            formulaBuilder.addEventListener('mouseup', saveSelection);
            formulaBuilder.addEventListener('keydown', onFormulaBuilderKeyDown);
            formulaBuilder.addEventListener('keyup', saveSelection);
            formulaBuilder.addEventListener('input', onFormulaBuilderInput);

            restoreFormula(hiddenFormulaPayload.innerText);

            // Set onClick for create new label button
            const createNewLabelButton = document.getElementById('create-new-label-button');
            createNewLabelButton.addEventListener('click', function(e) {
                e.preventDefault();
                showLabelModal();
            });

            const createNewVariableButton = document.getElementById('create-new-variable-button');
            createNewVariableButton.addEventListener('click', function(e) {
                e.preventDefault();
                showVariableModal();
            });

            // Set onClick for operations
            const operationButtons = document.querySelectorAll('.operationBtn');
            operationButtons.forEach(function(operation) {
                operation.addEventListener('click', function(e) {
                    e.preventDefault();
                    const operation = this.getAttribute('data-operation');
                    insertVariable(formulaBuilder, operation, null, false, true);
                });
            });

            // Set onClick for variables
            const clickAbles = document.querySelectorAll('.clickable');
            clickAbles.forEach(function(variable) {
                variable.addEventListener('click', function(e) {
                    e.preventDefault();
                    const variableName = this.getAttribute('data-name');
                    const variableId = this.getAttribute('data-id');
                    const isLabel = this.getAttribute('data-type') === 'label'
                    insertVariable(formulaBuilder, variableName, variableId, isLabel);
                });
            });

            // Set key down for modal input
            const labelNameInput = document.getElementById('create-new-label-modal-label-name');
            labelNameInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitLabelModal();
                }
            });

            // Set key down for modal input
            const variableNameInput = document.getElementById('create-new-variable-modal-variable-name');
            variableNameInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submitVariableModal();
                }
            });

            // Set onClick for label modal cancel button
            const labelModalCancelButton = document.getElementById('create-new-label-modal-cancel-button');
            labelModalCancelButton.addEventListener('click', function(e) {
                e.preventDefault();
                try {
                    modal.hide();
                } catch (e) {}
            });

            // Set onClick for variable modal cancel button
            const variableModalCancelButton = document.getElementById('create-new-variable-modal-cancel-button');
            variableModalCancelButton.addEventListener('click', function(e) {
                e.preventDefault();
                try {
                    modal.hide();
                } catch (e) {}
            });

            // Set onClick for label modal confirm button
            const labelModalConfirmButton = document.getElementById('create-new-label-modal-confirm-button');
            labelModalConfirmButton.addEventListener('click', function(e) {
                submitLabelModal();
            });

            // Set onClick for variable modal confirm button
            const variableModalConfirmButton = document.getElementById('create-new-variable-modal-confirm-button');
            variableModalConfirmButton.addEventListener('click', function(e) {
                submitVariableModal();
            });

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

            function restoreFormula(formula) {
                let insertLabelMode = false;
                let insertVariableMode = false;
                let newLineMode = false;

                for (let i = 0; i < formula.length; i++) {
                    let value = formula[i];
                    if (value === '<') {
                        insertLabelMode = true;
                    } else if (value === '>') {
                        insertLabelMode = false;
                        if (newLineMode) {
                            insertNewLine();
                            newLineMode = false;
                        }
                    } else if (value === '#' && insertVariableMode === false) {
                        insertVariableMode = true;
                    } else if (value === '#' && insertVariableMode === true) {
                        insertVariableMode = false;
                    } else if (value === '=') {
                        newLineMode = true;
                        insertVariable(formulaBuilder, formula[i], null, false, true);
                    } else if (insertLabelMode) {
                        const data = sliceAndMoveIndex(formula, i, '<', '>');
                        const name = findLabelNameFromId(data.slicedPart);
                        if (name) {
                            insertVariable(formulaBuilder, name, data.slicedPart, true, false);
                        }
                        // createStorageVariable(data.slicedPart);
                        i = data.updatedIndex - 1;
                    } else if (insertVariableMode) {
                        const data = sliceAndMoveIndex(formula, i, '#', '#');
                        const name = findVariableNameFromId(data.slicedPart);
                        if (name) {
                            insertVariable(formulaBuilder, name, data.slicedPart, false, false);
                        }
                        i = data.updatedIndex - 1;
                    } else {
                        insertVariable(formulaBuilder, formula[i], null, false, true);
                    }
                }

                // Destroy hidden element
                hiddenFormulaPayload.remove();
            }

            function sliceAndMoveIndex(str, i, startChar, endChar) {
                // Find the start of the delimiter (before the current 'i' position)
                let startPos = str.lastIndexOf(startChar, i);
                let endPos = str.indexOf(endChar, i); // Find the end of the delimiter

                if (startPos !== -1 && endPos !== -1) {
                    // Slice the content between the delimiters, excluding the delimiters themselves
                    const slicedPart = str.slice(startPos + 1, endPos); // Skip startChar

                    // Update 'i' to the position of the end character
                    i = endPos; // Move 'i' to after the endChar

                    return {
                        slicedPart,
                        updatedIndex: i
                    };
                }

                // If no matching endChar is found, return null and leave index unchanged
                return {
                    slicedPart: null,
                    updatedIndex: i
                };
            }

            // Find variable name by using given id by searching in elements with .variables class
            function findVariableNameFromId(id) {
                let name = '';
                const variables = document.querySelectorAll('.variable');
                for (let i = 0; i < variables.length; i++) {
                    const variable = variables[i];
                    const variableName = variable.getAttribute('data-name');
                    const variableId = variable.getAttribute('data-id');
                    if (id === variableId) {
                        name = variableName;
                        break;
                    }
                }

                return name;
            }

            function findLabelNameFromId(id) {
                let name = '';
                const labels = document.querySelectorAll('.label');
                for (let i = 0; i < labels.length; i++) {
                    const label = labels[i];
                    const labelName = label.getAttribute('data-name');
                    const labelId = label.getAttribute('data-id');
                    if (id === labelId) {
                        name = labelName;
                        break;
                    }
                }

                return name;
            }

            function insertNewLine() {
                const sel = window.getSelection();
                const range = sel.getRangeAt(0);

                // Create a <br> element
                const br = document.createElement("br");

                // Insert the <br> at the current cursor position
                range.insertNode(br);

                // Move the cursor after the <br> element
                range.setStartAfter(br);
                range.setEndAfter(br);

                // Remove the selection range to apply the changes
                sel.removeAllRanges();
                sel.addRange(range);
            }

            // Insert data into contenteditable at the saved cursor position
            function insertVariable(builder, data, id = null, isLabel = false, isRawText = false) {
                let dataToInsert;

                if (!isRawText) {
                    const span = document.createElement('span');
                    span.className = isLabel ? 'formula-label' : 'formula-variable';
                    span.innerText = data;
                    span.setAttribute('contenteditable', 'false'); // Make variable non-editable
                    span.setAttribute('dir', 'ltr');
                    dataToInsert = span;
                } else {
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
                 * Send raw text as it is, but for label send them wrapped between <>
                 * and for variables wrap their ids between two #
                 */
                updateFormula(
                    isRawText ? data : (isLabel ? '<' + id + '>' : '#' + id + '#'),
                    data.length,
                    false
                );
            }

            function moveCursorToEnd(contentEditableElement) {
                let range, selection;
                try {
                    if (document.createRange) //Firefox, Chrome, Opera, Safari, IE 9+
                    {
                        range = document
                            .createRange(); //Create a range (a range is a like the selection but invisible)
                        range.selectNodeContents(
                            contentEditableElement); //Select the entire contents of the element with the range
                        range.collapse(
                            false
                        ); //collapse the range to the end point. false means collapse to end rather than the start
                        selection = window
                            .getSelection(); //get the selection object (allows you to change selection)
                        selection.removeAllRanges(); //remove any selections already made
                        selection.addRange(range); //make the range you have just created the visible selection
                    } else if (document.selection) //IE 8 and lower
                    {
                        range = document.body
                            .createTextRange(); //Create a range (a range is a like the selection but invisible)
                        range.moveToElementText(
                            contentEditableElement); //Select the entire contents of the element with the range
                        range.collapse(
                            false
                        ); //collapse the range to the end point. false means collapse to end rather than the start
                        range.select(); //Select the range (make it the visible selection
                    }
                } catch (e) {}
            }

            function moveCursorForward(contentEditableElement, node) {
                let range, selection;
                try {
                    if (document.createRange) //Firefox, Chrome, Opera, Safari, IE 9+
                    {
                        range = document
                            .createRange(); //Create a range (a range is a like the selection but invisible)
                        range.selectNode(node); //Select the entire contents of the element with the range
                        range.collapse(
                            false
                        ); //collapse the range to the end point. false means collapse to end rather than the start
                        selection = window
                            .getSelection(); //get the selection object (allows you to change selection)
                        selection.removeAllRanges(); //remove any selections already made
                        selection.addRange(range); //make the range you have just created the visible selection
                    } else if (document.selection) //IE 8 and lower
                    {
                        range = document.body
                            .createTextRange(); //Create a range (a range is a like the selection but invisible)
                        range.moveToElementText(
                            contentEditableElement); //Select the entire contents of the element with the range
                        range.collapse(
                            false
                        ); //collapse the range to the end point. false means collapse to end rather than the start
                        range.select(); //Select the range (make it the visible selection
                    }
                } catch (e) {}
            }

            function showLabelModal() {
                const modalElement = document.getElementById('create-new-label-modal');
                const categories = modalElement.querySelector('#create-new-label-modal-label-category');

                // Clear all options except the first one
                categories.innerHTML = ''; //categories.options[0].outerHTML;

                const labels = document.querySelectorAll('.label');
                labels.forEach(function(label) {
                    const name = label.getAttribute('data-name');
                    const id = label.getAttribute('data-id');
                    const isParent = label.getAttribute('data-is-parent');

                    // Only add label variables which are parent
                    if (isParent) {
                        const option = document.createElement('option');
                        option.value = 'parent';
                        option.text = name;
                        option.selected = false;
                        option.setAttribute('data-id', id);
                        categories.appendChild(option);
                    }
                });

                categories.options.length > 0 ? categories.options[0].selected = true : undefined;

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

                const event = new CustomEvent('modal-open');
                document.querySelector('[x-data]').dispatchEvent(event);

                const modalCloseButton = document.getElementById('create-new-label-modal-close-button');
                modalCloseButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.hide();
                });
            }

            function submitLabelModal() {
                const modalElement = document.getElementById('create-new-label-modal');
                const labelNameInput = modalElement.querySelector('#create-new-label-modal-label-name');
                const labelType = modalElement.querySelector('#create-new-label-modal-label-type');
                const labelCategory = modalElement.querySelector('#create-new-label-modal-label-category');
                const confirmButtonText = modalElement.querySelector('#create-new-label-modal-confirm-button-text');
                const confirmButtonSpinner = modalElement.querySelector(
                    '#create-new-label-modal-confirm-button-spinner');

                // Don't send the request if input is empty
                if (labelNameInput.value.trim() === '') return;

                // Don't send another request if one is already sent
                if (confirmButtonText.classList.contains('hidden')) return;

                const labelName = labelNameInput.value;
                const selectedType = labelType.value;

                // If the label type is child, find its parent id
                let parentId = '';
                if (selectedType === 'child') {
                    const selectedIndex = labelCategory.selectedIndex;
                    const parentCategory = labelCategory.options[selectedIndex];
                    parentId = parentCategory.getAttribute('data-id');
                }

                try {
                    confirmButtonText.classList.add('hidden');
                    confirmButtonSpinner.classList.remove('hidden');
                    sendStoreLabelRequest(labelName, parentId === '' ? 1 : 0, parentId)
                        .then((response) => {
                            runIfDebug(DEBUG, console.log, 'Submit Label Response', response);
                            if (response && response.status === 201 && response.data && response.data.stored ===
                                true) {
                                const label = response.data.label;
                                createLabel(label.id, label.name, label.parent_id);
                                modal.hide();
                            }
                        })
                        .catch((error) => {
                            runIfDebug(DEBUG, console.error, 'Submit Label Error', error);
                        })
                        .finally(() => {
                            confirmButtonText.classList.remove('hidden');
                            confirmButtonSpinner.classList.add('hidden');
                        });
                } catch (e) {}
            }

            async function sendStoreLabelRequest(name, isParent, parentId) {
                const body = {
                    name,
                    type: isParent
                };
                if (!isParent) {
                    body.parent = parentId;
                }
                return await axios.post("/formula/label", body)
                    .then((res) => {
                        return res;
                    })
                    .catch((err) => {
                        runIfDebug(DEBUG, console.error, 'Submit Label Error', err);
                        return null
                    });
            }

            function createLabel(id, name, parentId) {
                const labelsContainer = document.getElementById('labelArea');
                const div = document.createElement('div');
                const p = document.createElement('p');

                div.setAttribute('contenteditable', 'false'); // Make variable non-editable
                div.setAttribute('dir', 'ltr');
                div.setAttribute('data-name', name);
                div.setAttribute('data-id', id);
                div.setAttribute('data-is-parent', parentId ? true : false);
                div.setAttribute('data-parent-id', parentId);
                div.setAttribute('data-type', 'label');

                p.className = 'w-full text-center';
                p.innerText = name;

                div.append(p);

                if (!parentId || parentId === '') {
                    const containerDiv = document.createElement('div');
                    containerDiv.className =
                        'flex flex-row flex-wrap gap-2 bg-gray-300 dark:bg-gray-800 rounded-md p-1';
                    div.className =
                        'label clickable secondary-button cursor-pointer bg-accent-500 dark:bg-accent py-1 px-2 min-w-16 rounded-md text-text text-sm';
                    containerDiv.append(div);
                    labelsContainer.append(containerDiv);
                } else {
                    div.className =
                        'label clickable secondary-button bg-accent-400 dark:bg-accent-600 py-1 px-2 min-w-16 rounded-md text-text text-sm cursor-pointer';
                    for (let i = 0; i < labelsContainer.children.length; i++) {
                        const container = labelsContainer.children[i];
                        const id = container.children[0].getAttribute('data-id');
                        if (id == parentId) {
                            labelsContainer.children[i].append(div);
                            break;
                        }
                    }
                }

                div.addEventListener('click', function(e) {
                    e.preventDefault();
                    insertVariable(formulaBuilder, name, id, true, false);
                });
            }

            function showVariableModal() {
                const modalElement = document.getElementById('create-new-variable-modal');

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

                const event = new CustomEvent('modal-open');
                document.querySelector('[x-data]').dispatchEvent(event);

                const modalCloseButton = document.getElementById('create-new-variable-modal-close-button');
                modalCloseButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.hide();
                });
            }

            function submitVariableModal() {
                const modalElement = document.getElementById('create-new-variable-modal');
                const variableNameInput = modalElement.querySelector('#create-new-variable-modal-variable-name');
                const confirmButtonText = modalElement.querySelector(
                    '#create-new-variable-modal-confirm-button-text');
                const confirmButtonSpinner = modalElement.querySelector(
                    '#create-new-variable-modal-confirm-button-spinner');

                // Don't send the request if input is empty
                if (variableNameInput.value.trim() === '') return;

                // Don't send another request if one is already sent
                if (confirmButtonText.classList.contains('hidden')) return;

                const variableName = variableNameInput.value;

                try {
                    confirmButtonText.classList.add('hidden');
                    confirmButtonSpinner.classList.remove('hidden');
                    sendStoreVariableRequest(variableName)
                        .then((response) => {
                            runIfDebug(DEBUG, console.log, response);
                            if (response && response.status === 201 && response.data && response.data.stored ===
                                true) {
                                const variabel = response.data.variable;
                                createVariable(variabel.id, variabel.name);
                                modal.hide();
                            }
                        })
                        .catch((error) => {
                            runIfDebug(DEBUG, console.error, error);
                        })
                        .finally(() => {
                            confirmButtonText.classList.remove('hidden');
                            confirmButtonSpinner.classList.add('hidden');
                        });
                } catch (e) {}
            }

            async function sendStoreVariableRequest(name, isParent, parentId) {
                const body = {
                    name,
                    type: isParent
                };
                if (!isParent) {
                    body.parent = parentId;
                }
                return await axios.post("/formula/variable", body)
                    .then((res) => {
                        return res;
                    })
                    .catch((err) => {
                        runIfDebug(DEBUG, console.error, err);
                        return null
                    });
            }

            function createVariable(id, name) {
                const variablesContainer = document.getElementById('variablesArea');

                const div = document.createElement('div');
                const p = document.createElement('p');

                div.className = 'clickable secondary-button formula-variable text-sm min-w-16';
                div.setAttribute('data-id', id);
                div.setAttribute('data-name', name)
                div.setAttribute('data-type', 'variable');

                p.className = 'w-full text-center';
                p.innerText = name;

                div.append(p);
                variablesContainer.append(div);

                div.addEventListener('click', function(e) {
                    e.preventDefault();
                    insertVariable(formulaBuilder, name, id, false, false);
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
                runIfDebug(DEBUG, console.log, 'Data', e);
                runIfDebug(DEBUG, console.log, 'Payload', formulaPayload);
                runIfDebug(DEBUG, console.log, 'Text content', formulaBuilder.textContent);

                if (e.inputType === 'deleteContentBackward') {
                    runIfDebug(DEBUG, console.log, "RANGE", savedRange.endOffset, savedRange.startOffset);
                    updateFormula(null, 0, true);
                } else if (e.data !== null) {
                    updateFormula(e.data);
                }

                saveSelection();
            }

            function updateFormula(data, length = 1, isDeletion = false) {
                const builderContent = formulaBuilder.textContent;

                let position = null;

                // Determine the minimum length to compare both strings
                const minLength = Math.min(builderContent.length, builderContentShadow.length);
                runIfDebug(DEBUG, console.log, "BuilderContent", builderContent);
                runIfDebug(
                    DEBUG, console.log,
                    'Builder Length', builderContent.length,
                    'Builder Shadow Length', builderContentShadow.length,
                    'Min Length', minLength
                );

                if (minLength === 0) {
                    position = minLength;
                } else {
                    // Loop through the strings to find the position where they differ
                    for (let i = 0; i <= minLength; i++) {
                        if (builderContentShadow[i] === undefined || builderContent[i] !== builderContentShadow[
                                i]) {
                            position = i;
                            break;
                        }
                    }
                }

                runIfDebug(DEBUG, console.log, "Position", position);

                // Update shadow to latest content
                builderContentShadow = builderContent;

                runIfDebug(DEBUG, console.log, "Deletion", isDeletion);

                if (isDeletion) {
                    if (builderContent === '') {
                        formulaPayload = '';
                        formulaPayloadShadow = [];
                    } else {
                        formulaPayload = '';
                        let length = 0;
                        for (let i = 0; i < formulaPayloadShadow.length; i++) {
                            if (formulaPayloadShadow[i].position === position) {
                                runIfDebug(DEBUG, console.log, 'i is', i, 'TO delete:', formulaPayloadShadow[i]);
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
                } else {
                    // Break the formula into array indexes
                    const formulaArray = breakStringIntoArray(formulaPayload);
                    runIfDebug(DEBUG, console.log, 'Array', formulaArray);

                    // Insert data at calculated position
                    formulaArray.splice(position, 0, data);

                    // Update formula payload shadow
                    formulaPayloadShadow.splice(position, 0, {
                        name: data,
                        position,
                        length
                    })

                    // Create a string from the array
                    formulaPayload = formulaArray.join('');
                }

                runIfDebug(DEBUG, console.log, 'Formula Payload:', formulaPayload);
                runIfDebug(DEBUG, console.log, 'Formula Payload Shadow:', formulaPayloadShadow);
                runIfDebug(DEBUG, console.log, '--------------------------');
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

                axios.post("/formula", {
                        name: formulaNameElement.value,
                        formula
                    })
                    .then(response => {
                        runIfDebug(DEBUG, console.log, 'Submit Formula Response', response);
                        if (response && response.status === 200) {
                            if (response.data.stored === true) {
                                showToastById('successToast');
                                clearFormulaForm();
                            } else {
                                showToastById('failToast');
                            }
                        }
                    })
                    .catch(error => {
                        runIfDebug(DEBUG, console.error, 'Submit Formula Error', error);
                        if (error && error.response) {
                            const response = error.response;
                            if (response.status === 422) {
                                if (response.data.errors.name) {
                                    formulaNameErrorLabel.innerText = response.data.errors.name[0] ?? response
                                        .data.message;
                                }
                                if (response.data.errors.formula) {
                                    formulaBuilderErrorLabel.innerText = response.data.errors.formula[0] ??
                                        response.data.message;
                                }
                            } else {
                                showToastById('failToast');
                            }
                        }
                    })
                    .finally(() => {
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

            function runIfDebug(debug, func, ...args) {
                if (debug) {
                    func(...args);
                }
            }
        });
    </script>
</x-app-layout>
