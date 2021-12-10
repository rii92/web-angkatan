@props(['provider', 'createdAt' => null])

<div>
    <div class="pl-3 flex items-center justify-between">
        <div class="flex items-center">
            @switch($provider)
                @case(JoelButcher\Socialstream\Providers::facebook())
                    <x-icons.facebook class="h-6 w-6 mr-2" />
                    @break
                @case(JoelButcher\Socialstream\Providers::google())
                    <x-icons.google class="h-6 w-6 mr-2" />
                    @break
                @case(JoelButcher\Socialstream\Providers::twitter())
                    <x-icons.twitter class="h-6 w-6 mr-2" />
                    @break
                @case(JoelButcher\Socialstream\Providers::linkedin())
                    <x-icons.linked-in class="h-6 w-6 mr-2" />
                    @break
                @case(JoelButcher\Socialstream\Providers::github())
                    <x-icons.github class="h-6 w-6 mr-2" />
                    @break
                @case(JoelButcher\Socialstream\Providers::gitlab())
                    <x-icons.gitlab class="h-6 w-6 mr-2" />
                    @break
                @case(JoelButcher\Socialstream\Providers::bitbucket())
                    <x-icons.bitbucket class="h-6 w-6 mr-2" />
                    @break
                @default
            @endswitch

            <div>
                <div class="text-sm font-semibold text-gray-600">
                    {{ __(ucfirst($provider)) }}
                </div>

                @if (! empty($createdAt))
                    <div class="text-xs text-gray-500">
                        Connected {{ $createdAt }}
                    </div>
                @else
                    <div class="text-xs text-gray-500">
                        {{ __('Not connected.') }}
                    </div>
                @endif
            </div>
        </div>

        <div>
            {{ $action }}
        </div>
    </div>

    @error($provider.'_connect_error')
        <div class="text-sm font-semibold text-red-500 px-3 mt-2">
            {{ $message }}
        </div>
    @enderror
</div>
