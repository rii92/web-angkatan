<header class="h-16 bg-blue-young-appbar font-poppins">
    <div class="flex items-center justify-between h-full px-6 mx-auto xl:container ">
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 text-gray-600 rounded-md xl:hidden focus:outline-none focus:text-purple-800 hover:text-purple-800" x-on:click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd">
                </path>
            </svg>
        </button>
        <div>
            <h2 class="px-0 text-lg font-semibold text-black lg:text-xl">
                {{ $title }}
            </h2>
        </div>
        <ul class="flex items-center flex-shrink-0 ml-auto space-x-6">
            <li class="dropdown-notification">
                @livewire('mahasiswa.notification')
            </li>
            <x-dashboard.header-profile />
        </ul>
    </div>
</header>