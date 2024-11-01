<x-basic-layout>
    <div class="bg-primary p-16 text-center">
        <p class="text-text text-2xl md:text-4xl font-bold">{{ __('privacy.privacy_policy') }}</p>
    </div>

    <div class="flex items-center w-full">
        <div class="w-full p-8">
            <div class="mt-8">
                <p class="text-text text-base font-normal text-justify">{{ __('privacy.privacy_policy_description') }}
                </p>
            </div>

            <div class="mt-8">
                <p class="text-text text-lg font-bold mb-8">{{ __('privacy.what_information_do_we_collect') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">
                    {{ __('privacy.personal_information_you_disclose_to_us') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.personal_information_you_disclose_to_us_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">
                    {{ __('privacy.information_automatically_collected') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.information_automatically_collected_description') }}</p>

                <p class="text-text text-lg font-bold my-8">{{ __('privacy.how_do_we_process_your_information') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.how_do_we_process_your_information_description1') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.how_do_we_process_your_information_description2') }}</p>

                <p class="text-text text-lg font-bold my-8">
                    {{ __('privacy.when_and_with_whom_do_we_share_your_personal_information') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.when_and_with_whom_do_we_share_your_personal_information_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">
                    {{ __('privacy.payment_processing_partners') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.payment_processing_partners_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('privacy.legal_compliance') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.legal_compliance_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('privacy.your_consent') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.your_consent_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">{{ __('privacy.business_transfers') }}
                </p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.business_transfers_description') }}</p>

                <p class="text-text text-base font-semibold text-justify mt-4">
                    {{ __('privacy.protecting_our_rights') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.protecting_our_rights_description') }}</p>

                <p class="text-text text-lg font-semibold text-justify mt-4">{{ __('privacy.do_we_use_cookies') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.do_we_use_cookies_description') }}</p>

                <p class="text-text text-lg font-semibold text-justify mt-4">
                    {{ __('privacy.how_do_we_handle_your_social_logins') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.how_do_we_handle_your_social_logins_description') }}</p>

                <p class="text-text text-lg font-semibold text-justify mt-4">
                    {{ __('privacy.how_long_do_we_keep_your_information') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.how_long_do_we_keep_your_information_description') }}</p>

                <p class="text-text text-lg font-semibold text-justify mt-4">
                    {{ __('privacy.do_we_make_updates_to_this_notice') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.do_we_make_updates_to_this_notice_description') }}</p>

                <p class="text-text text-lg font-semibold text-justify mt-4">
                    {{ __('privacy.how_can_you_contact_us_about_this_notice') }}</p>
                <p class="text-text text-base font-normal text-justify mt-4">
                    {{ __('privacy.how_can_you_contact_us_about_this_notice_description') }}
                    <span>{{ config('app.support_email') }}</span>
                </p>
            </div>
        </div>
</x-basic-layout>
