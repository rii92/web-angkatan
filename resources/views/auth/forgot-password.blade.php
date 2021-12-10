<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="email" value="{{ __('Email') }}" />
                <x-input.text name="email" id="email" :value="old('email')"  type="email" name="email" required autofocus/>
                <x-input.error for="email"/>
            </x-input.wrapper>

            <div class="flex items-center justify-end mt-4">
                <x-button.black type="submit">
                    {{ __('Send Reset Link') }}
                </x-button.black>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
