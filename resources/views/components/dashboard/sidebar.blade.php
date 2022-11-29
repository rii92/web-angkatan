<x-sidebar-layout>
    <x-dashboard.sidebar-item menu="Dashboard" href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
        @slot('icon')
            <x-icons.home stroke-width="2.0" width="22" height="22" />
        @endslot
    </x-dashboard.sidebar-item>

    @can(AppPermissions::ADMIN_ACCESS)
        <x-dashboard.sidebar-label value="Administrator" />
        <x-dashboard.sidebar-item menu="Users" href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
            @slot('icon')
                <x-icons.users stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
        <x-dashboard.sidebar-item menu="Role dan Permission" href="{{ route('admin.roles') }}" :active="request()->routeIs('admin.roles')">
            @slot('icon')
                <x-icons.user-group />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::SIMULATION_MANAGEMENT)
        <x-dashboard.sidebar-label value="Simulasi" />
        <x-dashboard.sidebar-item menu="Simulasi" href="{{ route('admin.simulasi.simulasi') }}" :active="request()->routeIs('admin.simulasi.simulasi')">
            @slot('icon')
                <x-icons.users-x stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
        <x-dashboard.sidebar-item menu="Formasi Satker" href="{{ route('admin.simulasi.satker') }}" :active="request()->routeIs('admin.simulasi.satker')">
            @slot('icon')
                <x-icons.briefcase />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::MEETING_MANAGEMENT)
        <x-dashboard.sidebar-label value="Administrasi" />
        <x-dashboard.sidebar-item menu="Meetings Management" href="{{ route('admin.meetings.table') }}" :active="request()->routeIs('admin.meetings.*')">
            @slot('icon')
                <x-icons.video stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @canany([AppPermissions::REPLY_KONSULTASI_UMUM, AppPermissions::REPLY_KONSULTASI_AKADEMIK,
        AppPermissions::TURNITIN_MANAGEMENT, AppPermissions::DELETE_SAMBAT, AppPermissions::SIMULATION_MANAGEMENT])
        <x-dashboard.sidebar-label value="Main Feature" />
    @endcanany

    @can(AppPermissions::REPLY_KONSULTASI_UMUM)
        <x-dashboard.sidebar-item menu="Konsultasi Umum" href="{{ route('admin.konsultasi.umum.table') }}"
            :active="request()->routeIs('admin.konsultasi.umum.*')">
            @slot('icon')
                <x-icons.chat stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::REPLY_KONSULTASI_AKADEMIK)
        <x-dashboard.sidebar-item menu="Konsultasi Akademik" href="{{ route('admin.konsultasi.akademik.table') }}"
            :active="request()->routeIs('admin.konsultasi.akademik.*')">
            @slot('icon')
                <x-icons.academic stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::TURNITIN_MANAGEMENT)
        <x-dashboard.sidebar-item menu="Turnitin Submission" href="{{ route('admin.turnitin.table') }}" :active="request()->routeIs('admin.turnitin.*')">
            @slot('icon')
                <x-icons.clipboard-check stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::DELETE_SAMBAT)
        <x-dashboard.sidebar-item menu="Sambat" href="{{ route('admin.sambat') }}" :active="request()->routeIs('admin.sambat')">
            @slot('icon')
                <x-icons.emoji-sad stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @canany([AppPermissions::ANNOUNCEMENT_MANAGEMENT, AppPermissions::TIMELINE_MANAGEMENT])
        <x-dashboard.sidebar-label value="Informasi" />
    @endcanany

    @can(AppPermissions::ANNOUNCEMENT_MANAGEMENT)
        <x-dashboard.sidebar-item menu="Announcement" href="{{ route('admin.announcement.table') }}" :active="request()->routeIs('admin.announcement.*')">
            @slot('icon')
                <x-icons.speakerphone stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

    @can(AppPermissions::TIMELINE_MANAGEMENT)
        <x-dashboard.sidebar-item menu="Timelines" href="{{ route('admin.timelines.table') }}" :active="request()->routeIs('admin.timelines.*')">
            @slot('icon')
                <x-icons.calendar stroke-width="2.0" width="22" height="22" />
            @endslot
        </x-dashboard.sidebar-item>
    @endcan

</x-sidebar-layout>
