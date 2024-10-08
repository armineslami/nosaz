<button {{ $attributes->merge(['type' => 'submit', 'class' => 'danger-button h-8 inline-flex justify-center items-center px-4 py-2 min-w-24 bg-red-600 border border-red-400 rounded-md font-semibold text-xs text-white uppercase shadow-sm hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

