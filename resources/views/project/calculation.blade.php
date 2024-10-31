<x-app-layout>
    <div class="max-w-7xl mx-auto text-text">
        <div class="flex justify-between">
            @if (isset($project['name']))
                <p class="text-text text-lg font-bold mb-2">{{ $project['name'] }}</p>
            @else
                <p class="text-text text-lg font-bold mb-2">{{ __('محاسبه پروژه') }}</p>
            @endif
            <button onclick="window.history.back()"
                class="flex md:hidden  text-sm p-2 relative bottom-2 text-gray-500 rounded-lg hover:text-text-900 hover:bg-primary dark:text-gray-400 dark:hover:text-text-100 dark:hover:bg-primary">
                <span class="sr-only">{{ __('بازگشت') }}</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>
        </div>
        <p class="text-text-600 dark:text-gray-400 text-sm">
            <span class="text-text-600 dark:text-gray-400 font-normal text-sm">{{ $formula->name }}</span>
        </p>
        @if (isset($project['description']))
            <p class="text-text text-sm my-4">{{ $project['description'] }}</p>
        @endif
        <x-card class="mt-8">
            @foreach ($labels as $label => $data)
                {{-- {{ dd($labels, $label, $data) }} --}}
                @if (isset($labels[$label]['value']))
                    <div class="flex gap-4 items-center mb-2 ">
                        <x-label-darken-text class="w-[fit-content] !truncate">
                            {{ $label }}
                        </x-label-darken-text>
                        <div class="grow h-0 border-b border-dashed border-b-slate-500">
                        </div>
                        <div class="w-[fit-content] text-text">
                            {{ convert_digits_to_persian(format_number_with_commas($data['value'], $settings->app_max_decimal_place)) }}
                            @if (isset($data['unit']))
                                <x-label-darken-text
                                    class="!text-text">{{ __('app.' . $data['unit']) }}</x-label-darken-text>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-xl font-semibold mb-4 !truncate">{{ $label }}</p>
                    @foreach ($data as $l => $d)
                        <div class="flex flex-wrap gap-4 items-center mb-2">
                            <x-label-darken-text class="w-[fit-content] !truncate">
                                {{ $l }}
                            </x-label-darken-text>
                            <div class="grow h-0 border-b border-dashed border-b-slate-500">
                            </div>
                            <div class="w-[fit-content] text-text">
                                {{ convert_digits_to_persian(format_number_with_commas($d['value'], $settings->app_max_decimal_place)) }}
                                @if (isset($d['unit']))
                                    <x-label-darken-text
                                        class="!text-text">{{ __('app.' . $d['unit']) }}</x-label-darken-text>
                                @endauth
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="mb-8"></div>
        @endforeach
    </x-card>
</div>
</x-app-layout>
