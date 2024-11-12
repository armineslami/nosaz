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
                </div>
            </div>
            <button x-data="" onclick="createPDF()"
                class="flex h-[fit-content] text-sm p-2 relative bottom-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary">
                <svg id="download-pdf-button" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <div id="download-pdf-spinner" role="status" class="hidden mt-1">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-accent"
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
            </button>
        </div>
        <div class="ms-2">
            @if (isset($project['description']))
                <p id="project-description" class="text-text text-sm my-4">{{ $project['description'] }}</p>
            @endif
        </div>

        <x-card class="mt-8" id="calculation-result">
            @foreach ($labels as $label => $data)
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
            <p class="text-[#101413] text-sm font-normal">
                {{ Str::replaceFirst('http://', '', Str::replaceFirst('https://', '', config('app.url'))) }}</p>
        </div>
    </x-card>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.createPDF = async function() {

            const button = document.getElementById('download-pdf-button');
            const spinner = document.getElementById('download-pdf-spinner');

            button.classList.add('hidden');
            spinner.classList.remove('hidden');

            const element = document.getElementById('calculation-result');

            // Deep cloning
            const clonedElement = element.cloneNode(true); // true for deep cloning

            /**
             * Add project title, formula and description
             */

            if (document.getElementById('project-description')) {
                const description = document.createElement('p');
                description.className = "text-[#101413] text-sm mb-7";
                description.textContent = document.getElementById('project-description').innerText;
                clonedElement.insertBefore(description, clonedElement.firstChild);
            }

            const formula = document.createElement('p');
            formula.className = "text-[#5b716c] font-normal text-sm mb-6";
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
            html2pdf().set(options).from(clonedElement).save().then(() => {
                spinner.classList.add('hidden');
                button.classList.remove('hidden');
            });
        }
    });
</script>
</x-app-layout>
