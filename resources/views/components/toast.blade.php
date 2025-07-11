<div {{ $attributes->merge(['class' => 'fixed flex bottom-24 md:bottom-8 mx-auto left-0 right-0 md:right-20 lg:right-0 items-center w-11/12 md:w-full max-w-sm p-4 space-x-4 rtl:space-x-reverse text-text bg-white dark:bg-gray-700 divide-x rtl:divide-x-reverse divide-gray-300 rounded-lg shadow dark:divide-gray-500']) }}
    role="alert">
    {!! $icon !!}
    <div class="ps-4 text-sm font-normal">
        <p class="mt-1">{!! $message !!}</p>
    </div>
</div>
