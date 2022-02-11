<div :class="{'block': isMenuOpen, 'hidden': ! isMenuOpen}" class="hidden lg:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-landingpage.responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            Home
        </x-landingpage.responsive-nav-link>
        <x-landingpage.responsive-nav-link href="{{ route('konsultasi.list') }}"
            :active="request()->routeIs('konsultasi')">
            Konsultasi
        </x-landingpage.responsive-nav-link>
        <x-landingpage.responsive-nav-link href="{{ route('sambat') }}" :active="request()->routeIs('sambat')">
            Sambat
        </x-landingpage.responsive-nav-link>
        <x-landingpage.responsive-nav-link href="{{ route('announcement') }}"
            :active="request()->routeIs('announcement')">
            Informasi
        </x-landingpage.responsive-nav-link>
    </div>
</div>
