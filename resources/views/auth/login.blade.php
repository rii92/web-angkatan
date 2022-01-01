<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}">
                <x-logo.image width="20" height="20" />
            </a>
        </x-slot>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <x-input.wrapper>
                <x-input.label for="email" value="{{ __('Email') }}" />
                <x-input.text name="email" id="email" :value="old('email')" type="email" name="email" required
                    autofocus />
                <x-input.error for="email" />
            </x-input.wrapper>

            <x-input.wrapper>
                <x-input.label for="password" value="{{ __('Password') }}" />
                <x-input.password name="password" id="password" type="password" required
                    autocomplete="current-password" />
                <x-input.error for="password" />
                <div>
                    @if (Route::has('password.request'))
                        <x-link class="text-sm" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </x-link>
                    @endif
                </div>
            </x-input.wrapper>

            <x-input.wrapper>
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </x-input.wrapper>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('register'))
                    <x-anchor.white href="{{ route('register') }}">
                        {{ __('Register') }}
                    </x-anchor.white>
                @endif

                <div class="ml-2">
                    <x-button.black type="submit">
                        {{ __('Log in') }}
                    </x-button.black>
                </div>
            </div>
        </form>

        @if (JoelButcher\Socialstream\Socialstream::show())
            <x-socialstream.providers />
        @endif

    </x-jet-authentication-card>
</x-guest-layout>
