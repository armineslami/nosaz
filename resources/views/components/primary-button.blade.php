<button {{ $attributes->merge(['type' => 'submit', 'class' => 'primary-button min-h-8 inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-text uppercase focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2-primary-600 dark:focus:ring-offset-primary-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
