<button {{ $attributes->merge(['type' => 'button', 'class' => 'secondary-button inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-text uppercase shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary-600 focus:ring-offset-secondary-600 dark:focus:ring-offset-secondary-600 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
