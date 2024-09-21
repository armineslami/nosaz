<x-basic-layout>
    <div class="bg-primary p-16 text-center">
        <p class="text-text text-4xl font-bold">{{ __('terms.terms_of_service') }}</p>
    </div>

    <div class="flex items-center w-full">
        <div class="w-full p-8">
            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.terms') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.terms_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.use_licence') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.use_licences_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.your_submission') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.your_submission_description1') }}</p>
                <p class="text-text text-base font-normal text-justify mt-6">{{ __('terms.your_responsible_for_what_you_upload') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.your_submission_description2') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.user_registration') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.user_registration_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-8">{{ __('terms.purchase_and_payment') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.payment_processing') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.payment_processing_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.payment_methods_and_currency') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.payment_methods_and_currency_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.security') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.security_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.subscription_services') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.subscription_services_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.changes_in_fees') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.changes_in_fees_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.responsibility') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.responsibility_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.taxes') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.taxes_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('terms.prohibited_use') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.prohibited_use_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.prohibited_activities') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.prohibited_activities_description1') }}</p>

                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.as_a_user_of_the_service_you_agree_not_to') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">{{ __('terms.prohibited_activities_description2') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.privacy_policy') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.privacy_policy_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.modifications_and_interruptions') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.modifications_and_interruptions_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.disclaimer') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.disclaimer_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.limitations') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.limitation_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.user_data') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.user_data_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.links') }}</p>
                <p class="text-text text-base font-normal text-justify">{{ __('terms.links_description') }}</p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-4">{{ __('terms.contact_us') }}</p>
                <p class="text-text text-base font-normal text-justify">
                    {{ __('terms.contact_us_description') }}
                    <span>{{ config('app.support_email') }}</span>
                </p>
            </div>
        </div>
    </div>
</x-basic-layout>
