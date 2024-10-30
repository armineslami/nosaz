@props(['url'])
<tr>
    <td class="header" style="background:#1D1E1F;">
        {{-- <div class="bg-[#1D1E1F] rounded-lg" style="width: 48px; height:48px;">
            <x-logo width="48px" height="48px" />
        </div> --}}
        <x-logo width="64px" height="64px" />
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
