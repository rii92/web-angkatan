<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-input.wrapper>
                <x-input.label for="email" value="{{ __('Email') }}" />
                <x-input.text name="email" id="email" :value="old('email', $request->email)"  type="email" name="email" required autofocus/>
                <x-input.error for="email"/>
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password" value="{{ __('Password') }}" />
                <x-input.password name="password" id="password"  type="password" name="password" required autocomplete="new-password"/>
                <x-input.error for="password"/>
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input.password name="password_confirmation" id="password_confirmation"  type="password" name="password_confirmation" required autocomplete="new-password"/>
                <x-input.error for="password_confirmation"/>
            </x-input.wrapper>

            <div class="flex items-center justify-end mt-4">
                <x-button.black type="submit">
                    {{ __('Reset Password') }}
                </x-button.black>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
