<li>
    <x-jet-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
            </button>
        </x-slot>

        <x-slot name="content">
            <x-jet-dropdown-link href="{{ route('user') }}">
                {{ __('My Dashboard') }}
            </x-jet-dropdown-link>

            @can(AppPermissions::DASHBOARD_ACCESS)
                <x-jet-dropdown-link href="{{ route('admin.dashboard') }}">
                    {{ __('Halaman Admin') }}
                </x-jet-dropdown-link>
            @endcan

            <x-jet-dropdown-link href="{{ route('home') }}">
                {{ __('Homepage') }}
            </x-jet-dropdown-link>

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
