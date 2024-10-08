<div {{ $attributes->merge(['class' => 'fixed flex bottom-20 md:bottom-8 mx-auto left-0 right-0 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-text bg-white dark:bg-gray-700 divide-x rtl:divide-x-reverse divide-gray-300 rounded-lg shadow dark:divide-gray-500']) }} role="alert">
    {!! $icon !!}
    <div class="ps-4 text-sm font-normal">
        <p class="mt-1">{!! $message !!}</p>
    </div>
</div>
