<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="name" value="{{ __('Name') }}" />
                <x-input.text name="name" id="name" :value="old('name')" type="text" name="name" required />
                <x-input.error for="name" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="email" value="{{ __('Email') }}" />
                <x-input.text name="email" id="email" :value="old('email')" type="email" name="email" required />
                <x-input.error for="email" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password" value="{{ __('Password') }}" />
                <x-input.password name="password" id="password" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input.error for="password" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input.password name="password_confirmation" id="password_confirmation" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input.error for="password_confirmation" />
            </x-input.wrapper>


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <x-input.wrapper>
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                I agree to the
                                <x-link href="{{ route('terms.show') }}">Terms of Service</x-link> and
                                <x-link href="{{ route('policy.show') }}">Privacy Policy</x-link>
                            </div>
                        </div>
                    </x-jet-label>
                    @error('terms')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </x-input.wrapper>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-anchor.white href="{{ route('login') }}">
                    {{ __('Login') }}
                </x-anchor.white>

                <div class="ml-2">
                    <x-button.black type="submit">
                        {{ __('Register') }}
                    </x-button.black>
                </div>
            </div>
        </form>
        @if (JoelButcher\Socialstream\Socialstream::show())
            <x-socialstream.providers />
        @endif
    </x-jet-authentication-card>
</x-guest-layout>
