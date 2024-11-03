<x-app-layout>
    <div class="max-w-7xl mx-auto text-text">
        <div class="flex justify-between">
            <div class="flex">
                <button onclick="window.history.back()"
                    class="flex md:hidden h-[fit-content] me-2  text-sm p-2 relative bottom-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary">
                    <span class="sr-only">{{ __('بازگشت') }}</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>
                <div>
                    @if (isset($project['name']))
                        <p id="project-title" class="text-text text-lg font-bold mb-2">{{ $project['name'] }}</p>
                    @else
                        <p id="project-title" class="text-text text-lg font-bold mb-2">{{ __('محاسبه پروژه') }}</p>
                    @endif
                    <p class="text-text-600 dark:text-gray-400 text-sm">
                        <span id="formula-name"
                            class="text-text-600 dark:text-gray-400 font-normal text-sm">{{ $formula->name }}</span>
                    </p>
                    {{-- @if (isset($project['description']))
                        <p id="project-description" class="text-text text-sm my-4">{{ $project['description'] }}</p>
                    @endif --}}
                </div>
            </div>
            <button x-data="" onclick="createPDF()"
                class="flex h-[fit-content] text-sm p-2 relative bottom-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary">
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
            </button>
        </div>
        <div class="ms-2">
            {{-- <p class="text-text-600 dark:text-gray-400 text-sm">
                <span id="formula-name"
                    class="text-text-600 dark:text-gray-400 font-normal text-sm">{{ $formula->name }}</span>
            </p> --}}
            @if (isset($project['description']))
                <p id="project-description" class="text-text text-sm my-4">{{ $project['description'] }}</p>
            @endif
        </div>

        <x-card class="mt-8" id="calculation-result">
            @foreach ($labels as $label => $data)
                {{-- {{ dd($labels, $label, $data) }} --}}
                @if (isset($labels[$label]['value']))
                    <div class="flex gap-4 items-center mb-2 ">
                        <x-label-darken-text class="label-text w-[fit-content] !truncate">
                            {{ $label }}
                        </x-label-darken-text>
                        <div class="label-divider grow h-0 border-b border-dashed border-b-slate-500">
                        </div>
                        <div class="label-value w-[fit-content] text-text">
                            {{ convert_digits_to_persian(format_number_with_commas($data['value'], $settings->app_max_decimal_place)) }}
                            @if (isset($data['unit']))
                                <x-label-darken-text
                                    class="label-unit !text-text">{{ __('app.' . $data['unit']) }}</x-label-darken-text>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="label-text text-xl font-semibold mb-4 !truncate">{{ $label }}</p>
                    @foreach ($data as $l => $d)
                        <div class="flex flex-wrap gap-4 items-center mb-2">
                            <x-label-darken-text class="label-text w-[fit-content] !truncate">
                                {{ $l }}
                            </x-label-darken-text>
                            <div class="label-divider grow h-0 border-b border-dashed border-b-slate-500">
                            </div>
                            <div class="label-value w-[fit-content] text-text">
                                {{ convert_digits_to_persian(format_number_with_commas($d['value'], $settings->app_max_decimal_place)) }}
                                @if (isset($d['unit']))
                                    <x-label-darken-text
                                        class="label-unit !text-text">{{ __('app.' . $d['unit']) }}</x-label-darken-text>
                                @endauth
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="mb-8"></div>
        @endforeach

        <div id="app-data" class="mt-12 text-center hidden">
            <p class="text-[#101413] text-sm font-bold">
                {{ app()->getLocale() === 'fa' ? config('app.name_fa') : config('app.name') }}</p>
            <p class="text-[#101413] text-sm font-normal">{{ config('app.url') }}</p>
        </div>
    </x-card>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.createPDF = async function() {
            const element = document.getElementById('calculation-result');

            // Deep cloning
            const clonedElement = element.cloneNode(true); // true for deep cloning

            /**
             * Add project title, formula and description
             */

            if (document.getElementById('project-description')) {
                const description = document.createElement('p');
                description.className = "text-[#101413] text-sm mb-8";
                description.textContent = document.getElementById('project-description').innerText;
                clonedElement.insertBefore(description, clonedElement.firstChild);
            }

            const formula = document.createElement('p');
            formula.className = "text-[#5b716c] font-normal text-sm mb-8";
            formula.textContent = document.getElementById('formula-name').innerText;
            clonedElement.insertBefore(formula, clonedElement.firstChild);

            const title = document.createElement('p');
            title.className = "text-[#101413]text-lg font-bold mb-2"
            title.textContent = document.getElementById('project-title').innerText;
            clonedElement.insertBefore(title, clonedElement.firstChild);

            /**
             * To make everything appear correctly on the pdf file, truncate classes needs to 
             * be removed. Also to aling the divider correctly, a top margin must be added to it. 
             */

            // Remove the 'truncate' class from all elements with 'label-text' class
            const labelTexts = clonedElement.getElementsByClassName('label-text');
            for (let i = 0; i < labelTexts.length; i++) {
                labelTexts[i].classList.remove('!truncate');
                labelTexts[i].classList.remove('text-text-600');
                labelTexts[i].classList.remove('dark:text-text-600');
                labelTexts[i].classList.add('!text[#5b716c]');

            }
            // Add '1.25rem' top margin to all elements with 'label-divider' class
            const labelDividers = clonedElement.getElementsByClassName('label-divider');

            for (let i = 0; i < labelDividers.length; i++) {
                labelDividers[i].style.marginTop = '1.25rem'; // Set top margin to 1.25rem
            }

            const labelValues = clonedElement.getElementsByClassName('label-value');
            for (let i = 0; i < labelValues.length; i++) {
                labelValues[i].classList.remove('!text-text');
                labelValues[i].classList.add('!text-[#101413]');
            }

            const labelUnits = clonedElement.getElementsByClassName('label-unit');
            for (let i = 0; i < labelUnits.length; i++) {
                labelUnits[i].classList.remove('!text-text');
                labelUnits[i].classList.add('!text-[#101413]');
            }

            /**
             * Add app name
             */
            clonedElement.querySelector('#app-data').classList.remove('hidden');

            clonedElement.classList.remove('bg-background-100');
            clonedElement.classList.add('bg-[#e3e8e7]');

            const options = {
                margin: 0.4,
                filename: `${document.getElementById('project-title').innerText}.pdf`,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            await window.importHTML2PDF();

            // Generate PDF
            html2pdf().set(options).from(clonedElement).save();
        }
    });
</script>
</x-app-layout>
