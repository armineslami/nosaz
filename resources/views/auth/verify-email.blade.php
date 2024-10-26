<x-basic-layout>
    <div class="flex items-center min-h-screen">
        <div class="w-full md:w-1/2 m-4 md:m-auto">

            {{-- <x-application-logo class="m-auto w-24 h-24 mb-8 rounded-lg px-2 bg-primary" /> --}}

            <div>
                <p class="text-text text-lg font-bold mb-2">{{ __('فعال سازی حساب کاربری') }}</p>
                <p class="text-text-600 dark:text-gray-400 text-sm justify-center">
                    {{ __('برای ورود به پنل ایمیل خود را تایید کنید.') }}
                </p>
            </div>

            <x-card class="mt-8 max-w-7xl mx-auto">
                <div class="mb-8 text-sm text-text text-justify">
                    {{ __('verify-email.thanks_for_sign_up') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('verify-email.verification_email_is_sent') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="text-sm text-text-600 dark:text-text-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('verify-email.log_out') }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <x-primary-button>
                                {{ __('verify-email.resend_email') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </x-card>
        </div>
    </div>
</x-basic-layout>
