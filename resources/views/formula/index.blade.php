<x-app-layout>
    <div class="max-w-7xl mx-auto">
        @if (count($formulas) > 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-4 md:p-6 overflow-x-auto">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                    #</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                    {{ __('نام') }}</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                    {{ __('تاریخ بروز رسانی') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 text-start">
                            @foreach ($formulas as $formula)
                                <tr class="md:hover:bg-gray-100 md:dark:hover:bg-gray-700 cursor-pointer"
                                    onclick="location.href='{{ route('formula.index', ['id' => $formula->id]) }}'">
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 text-text whitespace-nowrap">
                                        {{ $loop->index + 1 + ($formulas->currentPage() - 1) * $formulas->perPage() }}
                                    </td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 text-text whitespace-nowrap">
                                        {{ $formula->name }}</td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 text-text whitespace-nowrap">
                                        @if ($formula->updated_at->isToday())
                                            {{ __('app.today') }}
                                        @elseif ($formula->updated_at->isYesterday())
                                            {{ __('app.yesterday') }}
                                        @elseif ($formula->updated_at->diffInDays(now()) <= 7)
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) $formula->updated_at->diffInDays(now())) : (int) $formula->updated_at->diffInDays(now())) . ' ' . __('app.day_ago') }}
                                        @elseif ($formula->updated_at->diffInWeeks(now()) <= 4)
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) $formula->updated_at->diffInWeeks(now())) : (int) $formula->updated_at->diffInWeeks(now())) . ' ' . __('app.week_ago') }}
                                        @elseif ($formula->updated_at->diffInMonths(now()) <= 12)
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) $formula->updated_at->diffInMonths(now())) : (int) $formula->updated_at->diffInMonths(now())) . ' ' . __('app.month_ago') }}
                                        @else
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) $formula->updated_at->diffInYears(now())) : (int) $formula->updated_at->diffInYears(now())) . ' ' . __('app.year_ago') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="table-nav mt-4 text-slate-400 dark:text-slate-200">
                        {{ $formulas->links() }}
                    </div>
                </div>
            </div>
        @else
            @include('formula.empty')
        @endif

        @if (isset($sharedFormula))
            @include('formula.import-formula-modal')
        @endif

        @if (session('status') === 'formula-deleted')
            <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)" class="hidden" id="toast"
                icon='<svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
                message="{{ __('فرمول با موفقیت حذف شد') }}" />
        @elseif (session('status') === 'share-link-not-valid')
            <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)" class="hidden" id="toast"
                icon='<svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
                message="{{ __('لینک اشتراکی معتبر نیست') }}" />
        @elseif (session('status') === 'formula-already-exists')
            <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)" class="hidden" id="toast"
                icon='<svg class="w-5 h-5 text-text" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" /></svg>'
                message="{{ __('فرمول قبلا ساخته شده است') }}" />
        @endif
    </div>
</x-app-layout>
