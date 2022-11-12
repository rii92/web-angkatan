<x-sidebar-layout>
    <x-dashboard.sidebar-item menu="Info Skripsi" href="{{ route('user.skripsi') }}"
        :active="request()->routeIs('user.skripsi')">
        @slot('icon')
            <x-icons.book-open stroke-width="2.0" width="22" height="22" />
        @endslot
    </x-dashboard.sidebar-item>
    <x-dashboard.sidebar-item menu="Profile" href="{{ route('profile.show') }}"
        :active="request()->routeIs('profile.show')">
        @slot('icon')
            <x-icons.users stroke-width="2.0" width="22" height="22" />
        @endslot
    </x-dashboard.sidebar-item>

    @can(AppPermissions::SIMULATION_ACCESS)
        <x-dashboard.sidebar-item menu="Simulasi Penempatan" href="{{ route('user.simulasi.table') }}"
            :active="request()->routeIs('user.simulasi.*')">
            @slot('icon')
                <x-icons.users-x stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::MAKE_KONSULTASI)
        <x-dashboard.sidebar-item menu="Konsultasi Umum" href="{{ route('user.konsultasi.umum.table') }}"
            :active="request()->routeIs('user.konsultasi.umum.*')">
            @slot('icon')
                <x-icons.chat stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
        <x-dashboard.sidebar-item menu="Konsultasi Akademik" href="{{ route('user.konsultasi.akademik.table') }}"
            :active="request()->routeIs('user.konsultasi.akademik.*')">
            @slot('icon')
                <x-icons.academic stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::MAKE_TURNITIN)
        <x-dashboard.sidebar-item menu="Turnitin Submission" href="{{ route('user.turnitin.table') }}"
            :active="request()->routeIs('user.turnitin.*')">
            @slot('icon')
                <x-icons.clipboard-check stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    <x-dashboard.sidebar-item menu="Sambat" href="{{ route('user.sambat.table') }}"
        :active="request()->routeIs('user.sambat.*')">
        @slot('icon')
            <x-icons.emoji-sad stroke-width="2.0" width="22" height="22" />
        @endslot
    </x-dashboard.sidebar-item>
</x-sidebar-layout>
