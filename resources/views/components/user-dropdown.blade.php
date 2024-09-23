<div class="z-50 !mx-4 my-4 w-56 text-base list-none bg-white rounded-lg divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
    <div class="py-3 px-4">
        <span class="block text-sm font-semibold text-gray-900 dark:text-white">
            {{ Auth::user()->name }}
        </span>
        <span class="block text-sm text-gray-900 truncate dark:text-white">
            {{ Auth::user()->email }}
        </span>
    </div>
    <a href="{{ route('profile.edit') }}" class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
        <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-dropdown-link>
    </a>
    <a class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link
                :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </a>
</div>
