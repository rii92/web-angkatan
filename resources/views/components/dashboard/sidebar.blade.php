<x-sidebar-layout>
    <x-dashboard.sidebar-item menu="Home" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        @slot('icon')
            <x-icons.home/>
        @endslot
    </x-dashboard.sidebar-item>
</x-sidebar-layout>
