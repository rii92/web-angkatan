<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="password" value="{{ __('Password') }}" />
                <x-input.password name="password" id="password"  type="password" required autocomplete="current-password"/>
                <x-input.error for="password"/>
            </x-input.wrapper>

            <div class="flex justify-end mt-4">
                <x-button.black type="submit">
                    {{ __('Confirm') }}
                </x-button.black>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
