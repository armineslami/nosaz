<x-app-layout>
    <div>
        @if(count($formulas) > 0 )
            <div>Formulas</div>
        @else
            @include('formula.empty')
        @endif
    </div>
</x-app-layout>
