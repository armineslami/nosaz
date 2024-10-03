<button {{ $attributes->merge(['type' => 'submit', 'class' => 'primary-button h-8 inline-flex justify-center items-center px-4 py-2 min-w-24 bg-primary border border-primary-500 rounded-md font-semibold text-xs text-text uppercase shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2-primary-600 dark:focus:ring-offset-primary-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
