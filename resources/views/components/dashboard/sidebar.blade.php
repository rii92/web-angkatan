<x-sidebar-layout>
    <x-dashboard.sidebar-item menu="Dashboard" href="{{ route('admin.dashboard') }}"
        :active="request()->routeIs('admin.dashboard')">
        @slot('icon')
        <x-icons.home />
        @endslot
    </x-dashboard.sidebar-item>

    <x-dashboard.sidebar-label value="Administrator" />
    <x-dashboard.sidebar-item menu="Users" href="{{ route('admin.users') }}"
        :active="request()->routeIs('admin.users')">
        @slot('icon')
        <x-icons.users />
        @endslot
    </x-dashboard.sidebar-item>
    <x-dashboard.sidebar-item menu="Role dan Permission" href="{{ route('admin.roles') }}"
        :active="request()->routeIs('admin.roles')">
        @slot('icon')
        <x-icons.user-group />
        @endslot
    </x-dashboard.sidebar-item>

    <x-dashboard.sidebar-label value="Konsultasi dan Sambat" />
    <x-dashboard.sidebar-item menu="Konsultasi Umum" href="{{ route('admin.konsultasi-umum') }}"
        :active="request()->routeIs('admin.konsultasi-umum')">
        @slot('icon')
        <x-icons.chat />
        @endslot
    </x-dashboard.sidebar-item>
    <x-dashboard.sidebar-item menu="Konsultasi Akademik" href="{{ route('admin.konsultasi-akademik') }}"
        :active="request()->routeIs('admin.konsultasi-akademik')">
        @slot('icon')
        <x-icons.academic />
        @endslot
    </x-dashboard.sidebar-item>
    <x-dashboard.sidebar-item menu="Sambat" href="{{ route('admin.sambat') }}"
        :active="request()->routeIs('admin.sambat')">
        @slot('icon')
        <x-icons.emoji-sad />
        @endslot
    </x-dashboard.sidebar-item>

    <x-dashboard.sidebar-label value="Informasi" />
    <x-dashboard.sidebar-item menu="Pengumuman" href="{{ route('admin.pengumuman') }}"
        :active="request()->routeIs('admin.pengumuman')">
        @slot('icon')
        <x-icons.speakerphone />
        @endslot
    </x-dashboard.sidebar-item>
    <x-dashboard.sidebar-item menu="Berita" href="{{ route('admin.berita') }}"
        :active="request()->routeIs('admin.berita')">
        @slot('icon')
        <x-icons.book-open />
        @endslot
    </x-dashboard.sidebar-item>

</x-sidebar-layout>
