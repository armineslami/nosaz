<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-8">
        <div>
            @include('profile.partials.update-profile-information-form')
        </div>
        <div>
            @include('profile.partials.update-password-form')
        </div>
        <div>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
