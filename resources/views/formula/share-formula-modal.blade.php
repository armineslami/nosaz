<x-modal name="share-formula" maxWidth="lg" focusable>
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ __('اشتراک گذاری فرمول') }}
        </h3>
        <button x-on:click="$dispatch('close')" type="button"
            class="text-gray-500 bg-transparent hover:text-text-900 hover:bg-primary dark:hover:text-text-100 dark:hover:bg-primary rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white focus:outline-none">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">{{ __('بستن') }}</span>
        </button>
    </div>
    <div class="p-4 md:p-5">
        <p class="text-sm font-normal text-gray-900 dark:text-white">
            {{ __('با ارسال لینک زیر به دیگران، می‌توانید فرمول خود را به اشتراک بگذارید.') }}
        </p>
        <div
            class="grid grid-cols-12 gap-1 my-8 ltr relative p-3 text-xs font-bold text-text rounded-lg bg-gray-50 dark:bg-gray-900">
            <p class="col-span-11 truncate" id="formula-share-address">
                {{ $share_address }}
            </p>
            <span id="copy-formula" class="relative m-auto left-0 right-0 cursor-pointer text-xs text-text"
                x-on:click="copy('{{ $share_address }}')">
                <span id="copy-text">{{ __('کپی') }}</span>
                <svg id="copy-icon" class="hidden w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 11.917 9.724 16.5 19 7.5" />
                </svg>
            </span>
        </div>
    </div>
</x-modal>
<script>
    function copy(text) {
        const checkIcon = document.getElementById("copy-icon");
        const copyText = document.getElementById("copy-text");

        checkIcon.classList.toggle('hidden');
        copyText.classList.toggle('hidden');

        setTimeout(() => {
            checkIcon.classList.toggle('hidden');
            copyText.classList.toggle('hidden');
        }, 1000);

        if (window.clipboardData && window.clipboardData.setData) {
            // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
            return window.clipboardData.setData("Text", text);

        } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
            var textarea = document.createElement("textarea");
            textarea.textContent = text;
            textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in Microsoft Edge.
            document.body.appendChild(textarea);
            textarea.select();
            try {
                return document.execCommand("copy"); // Security exception may be thrown by some browsers.
            } catch (ex) {
                console.warn("Copy to clipboard failed.", ex);
                // return prompt("Copy to clipboard: Ctrl+C, Enter", text);
            } finally {
                document.body.removeChild(textarea);
            }
        }
    }
</script>
