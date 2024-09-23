<x-basic-layout>
    <div class="flex items-center min-h-screen">
        <div class="w-full md:w-1/2 m-4 md:m-auto">

{{--            <x-application-logo class="m-auto w-24 h-24 mb-8 fill-primary" />--}}

            <div class="p-8 bg-white dark:bg-gray-800 rounded-lg">
                <div class="mb-8 text-sm text-text text-justify">
                    {{ __('verify-email.thanks_for_sign_up') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('verify-email.verification_email_is_sent') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <x-primary-button>
                                {{ __('verify-email.resend_email') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="text-sm text-text-600 dark:text-text-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('verify-email.log_out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-basic-layout>
