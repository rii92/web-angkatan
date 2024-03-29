<x-dashboard-layout title="Profile">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            <div class="mt-5 sm:mt-0">
                @livewire('profile.details')
            </div>

            <x-jet-section-border />

            <div class="mt-5 sm:mt-0">
                @livewire('profile.address')
            </div>

            @hasanyrole(AppRoles::USERS . '|' . AppRoles::D3_61)
                {{-- <x-jet-section-border />
                <div class="mt-5 sm:mt-0">
                    @livewire('profile.skripsi')
                </div> --}}

                <x-jet-section-border />
                <div class="mt-5 sm:mt-0">
                    @livewire('profile.setting')
                </div>
            @endhasanyrole

            <x-jet-section-border />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()) && !is_null($user->password))
                <div class="mt-5 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @else
                <div class="mt-5 sm:mt-0">
                    @livewire('profile.set-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication() && !is_null($user->password))
                <div class="mt-5 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            {{-- @if (JoelButcher\Socialstream\Socialstream::show())
                <div class="mt-5 sm:mt-0">
                    @livewire('profile.connected-accounts-form')
                </div>
            @endif --}}


            {{-- @if (!is_null($user->password))
                <x-jet-section-border />

                <div class="mt-5 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
            @endif --}}

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures() && !is_null($user->password))
                <x-jet-section-border />

                <div class="mt-5 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
    </x-app-layout>
