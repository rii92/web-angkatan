<x-sidebar-layout>
    <x-dashboard.sidebar-item menu="Home" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        @slot('icon')
            <x-icons.home/>
        @endslot
    </x-dashboard.sidebar-item>
    <x-dashboard.sidebar-item menu="Users" href="{{ route('dashboard.users') }}" :active="request()->routeIs('dashboard.users')">
        @slot('icon')
            <x-icons.users/>
        @endslot
    </x-dashboard.sidebar-item>
</x-sidebar-layout>
