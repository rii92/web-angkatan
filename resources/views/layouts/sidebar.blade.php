<!-- Desktop sidebar -->
<aside
    class="z-20 hidden w-72 font-poppins overflow-y-auto bg-white xl:block flex-shrink-0 border-r border-gray-100 shadow-md">
    <div class="pb-5 text-gray-500">
        <div class="flex items-center h-16">
            <x-logo.full class="ml-5" />
        </div>

        <div class="flex items-center bg-subtle rounded-tr-lg rounded-br-lg px-5 py-3 mr-5 mt-3 mb-5">
            <img class="h-8 w-8 rounded-full object-cover bg-lighter mr-3" src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}" />
            <span class="font-semibold text-lighter text-base">Halo
                {{ Str::of(Auth::user()->name)->explode(' ')->first() }}</span>
        </div>

        <ul id="desktop-sidebar">
            {{ $slot }}
        </ul>

    </div>
</aside>
<!-- Mobile sidebar -->
<aside
    class="fixed inset-y-0 z-20 flex-shrink-0 w-72 font-poppins mt-16 overflow-y-auto bg-white xl:hidden border-r-2 border-gray-100 shadow-md"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu" x-cloak>
    <div class="py-4 text-gray-500">
        <x-logo.full class="ml-5" />

        <ul class="mt-3" id="mobile-sidebar">
            {{ $slot }}
        </ul>

    </div>
</aside>
