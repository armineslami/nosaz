<x-app-layout>
    <div>
        @if(count($formulas) > 0 )
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-4 md:p-6 overflow-x-auto">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">#</th>
                            <th class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">{{ __('نام') }}</th>
                            <th class="border-b dark:border-slate-600 font-medium text-start p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-500">{{ __('تاریخ بروز رسانی') }}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 text-start">
                        @foreach ($formulas as $formula)
                            <tr class="md:hover:bg-gray-100 md:dark:hover:bg-gray-700 cursor-pointer" onclick="location.href='{{route('formula.index', ['id' => $formula->id])}}'">
                                <td class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">{{ $loop->index + 1 + ($formulas->currentPage() - 1) * $formulas->perPage() }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">{{ $formula->name }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 text-start p-4 pl-8 text-text">{{ $formula->updated_at }}</td>
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
    </div>
</x-app-layout>
