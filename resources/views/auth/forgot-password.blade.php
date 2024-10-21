<x-basic-layout>
    <div class="flex items-center min-h-screen">
        <div class="w-full md:w-1/2 m-4 md:m-auto">

            {{--            <x-application-logo class="m-auto w-24 h-24 mb-8 fill-primary" /> --}}

            <div class="p-8 bg-white dark:bg-gray-800 rounded-lg">
                <div class="mb-8 text-sm text-text">
                    {{ __('forgot-password.forgot_password_no_problem') }}
                </div>

                <!-- Session Status -->
                {{-- <x-auth-session-status class="mb-8" :status="session('status')" /> --}}

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('forgot-password.email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" placeholder="{{ __('forgot-password.enter_your_email') }}" required
                            autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-primary-button>
                            {{ __('forgot-password.send_reset_link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('status'))
        <x-toast x-data="{ show: true }" x-show="show" x-init="$el.classList.add('toast-transition-in');
        $el.classList.remove('hidden');
        setTimeout(() => {
            $el.classList.remove('toast-transition-in');
            $el.classList.add('toast-transition-out');
            show = false;
        }, 5000)" class="hidden"
            icon='<svg class="w-5 h-5 text-text" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>'
            message="{{ session('status') }}" />
    @endif
</x-basic-layout>
