<x-app-layout>
    <div class="max-w-7xl mx-auto">
        @if (count($projects) > 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-4 md:p-6 overflow-x-auto">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">
                                    #</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">
                                    {{ __('نام') }}</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">
                                    {{ __('فرمول') }}</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">
                                    {{ __('تاریخ بروز رسانی') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 text-start">
                            @foreach ($projects as $project)
                                <tr class="md:hover:bg-gray-100 md:dark:hover:bg-gray-700 cursor-pointer"
                                    onclick="location.href='{{ route('project.index', ['id' => $project->id]) }}'">
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">
                                        {{ $loop->index + 1 + ($projects->currentPage() - 1) * $projects->perPage() }}
                                    </td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">
                                        {{ $project->name }}
                                    </td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">
                                        {{ $project->formula !== null ? $project->formula->name : __('پیشفرض') }}
                                    </td>
                                    <td
                                        class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">
                                        @if ($project->updated_at->isToday())
                                            {{ __('app.today') }}
                                        @elseif ($project->updated_at->isYesterday())
                                            {{ __('app.yesterday') }}
                                        @elseif (now()->diffInDays($project->updated_at) <= 7)
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) now()->diffInDays($project->updated_at, false)) : (int) now()->diffInDays($project->updated_at)) . ' ' . __('app.day_ago') }}
                                        @elseif (now()->diffInWeeks($project->updated_at) <= 4)
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) now()->diffInWeeks($project->updated_at)) : (int) now()->diffInWeeks($project->updated_at)) . ' ' . __('app.week_ago') }}
                                        @elseif (now()->diffInMonths($project->updated_at) <= 12)
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) now()->diffInMonths($project->updated_at)) : (int) now()->diffInMonths($project->updated_at)) . ' ' . __('app.month_ago') }}
                                        @else
                                            {{ (app()->getLocale() === 'fa' ? convert_digits_to_persian((int) now()->diffInYears($project->updated_at)) : (int) now()->diffInYears($project->updated_at)) . ' ' . __('app.year_ago') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="table-nav mt-4 text-slate-400 dark:text-slate-200">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        @else
            @include('project.empty')
        @endif
        @if (session('status') === 'project-destroyed')
            <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
            $el.classList.remove('hidden');
            setTimeout(() => {
                $el.classList.remove('toast-transition-in');
                $el.classList.add('toast-transition-out');
                show = false;
            }, 5000)" class="hidden" id="toast"
                icon='<svg class="w-5 h-5 text-text" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round"d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>'
                message="{{ __('پروژه با موفقیت حذف شد') }}" />
        @endif
    </div>
</x-app-layout>
