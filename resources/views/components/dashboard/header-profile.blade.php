<li>
    <x-jet-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex text-sm transition border-2 rounded-full focus:outline-none focus:border-gray-300">
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
            </button>
        </x-slot>

        <x-slot name="content">
            @php
                $isAdminPage = Str::contains(\Request::route()->getName(), 'admin');
                $isUserPage = Str::contains(\Request::route()->getName(), 'user');
                $isDashboardPage = $isAdminPage || $isUserPage;
            @endphp

            @if (!$isDashboardPage || $isAdminPage)
                <x-jet-dropdown-link href="{{ route('user') }}">
                    {{ __('My Dashboard') }}
                </x-jet-dropdown-link>
            @endif

            @if (!$isDashboardPage || $isUserPage)
                @can(AppPermissions::DASHBOARD_ACCESS)
                    <x-jet-dropdown-link href="{{ route('admin.dashboard') }}">
                        {{ __('Halaman Admin') }}
                    </x-jet-dropdown-link>
                @endcan
            @endif

            @if ($isDashboardPage)
                <x-jet-dropdown-link href="{{ route('home') }}">
                    {{ __('Homepage') }}
                </x-jet-dropdown-link>
            @endif

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </form>
        </x-slot>
    </x-jet-dropdown>
</li>
