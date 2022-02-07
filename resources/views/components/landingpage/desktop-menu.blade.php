<div class="flex w-auto mr-auto">
    <div class="hidden space-x-8 lg:flex">
        <x-landingpage.nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            Home
        </x-landingpage.nav-link>
        <x-landingpage.nav-link href="{{ route('konsultasi.list') }}" :active="request()->routeIs('konsultasi.*')">
            Konsultasi
        </x-landingpage.nav-link>
        <x-landingpage.nav-link href="{{ route('sambat') }}" :active="request()->routeIs('sambat')">
            Sambat
        </x-landingpage.nav-link>
        <x-landingpage.nav-link href="{{ route('announcement') }}"
            :active="request()->routeIs('announcement')||request()->routeIs('announcement.*')">
            Informasi
        </x-landingpage.nav-link>
    </div>
</div>
