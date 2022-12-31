<!-- Desktop sidebar -->
<aside
    class="z-20 flex-shrink-0 hidden overflow-y-auto border-r border-gray-100 shadow-md w-72 font-poppins bg-blue-sidebar xl:block">
    <div class="pb-5 text-gray-500">
        <div class="flex items-center h-16">
            <x-logo.full class="ml-5" />
        </div>

        <div class="flex items-center px-5 py-3 mt-3 mb-5 mr-5 rounded-tr-lg rounded-br-lg bg-font-color-sub">
            <img class="object-cover w-8 h-8 mr-3 rounded-full bg-blueButton" src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}" />
            <span class="text-base font-semibold text-white">Halo
                {{ Str::of(Auth::user()->name)->explode(' ')->first() }}</span>
        </div>

        <ul id="desktop-sidebar">
            {{ $slot }}
        </ul>

    </div>
</aside>
<!-- Mobile sidebar -->
<aside
    class="fixed inset-y-0 z-20 flex-shrink-0 mt-16 overflow-y-auto border-r-2 border-gray-100 shadow-md bg-blue-sidebar w-72 font-poppins xl:hidden"
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
