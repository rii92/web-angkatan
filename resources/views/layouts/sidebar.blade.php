<!-- Desktop sidebar -->
<aside
    class="z-10 hidden w-64 overflow-y-auto bg-white xl:block flex-shrink-0 border-r border-gray-100 shadow-md scroll-style">
    <div class="py-5 text-gray-500">
        <a class="ml-6 flex" href="#">
            <x-logo.text/>
        </a>

        <ul class="mt-5" id="desktop-sidebar">
            {{ $slot }}
        </ul>

    </div>
</aside>
<!-- Mobile sidebar -->
<aside
    class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white xl:hidden border-r-2 border-gray-100 scroll-style"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu" x-cloak>
    <div class="py-4 text-gray-500">
        <a class="ml-6 flex" href="#">
            <x-logo.text/>
        </a>

        <ul class="mt-3" id="mobile-sidebar">
            {{ $slot }}
        </ul>

    </div>
</aside>
