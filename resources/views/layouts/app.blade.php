<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ ucfirst($title) }} | {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/logo_angkatan.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/chat.css') }}">
    <link rel="stylesheet" href="{{ mix('css/animation.css') }}">
    <link rel="stylesheet" href="{{ mix('css/announcement.css') }}">
    @stack('styles')

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-archivo-narrow antialiased">
    <x-jet-banner />

    <div class="min-h-screen">
        <nav class="font-poppins shadow mb-2" x-data="{ isMenuOpen: false }" @keydown.escape="isMenuOpen = false">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Mobile hamburger -->
                        <button class="p-1 mr-5 -ml-1 rounded-md xl:hidden focus:outline-none focus:text-purple-800 hover:text-purple-800 text-gray-600" @click="isMenuOpen = !isMenuOpen" aria-label="Menu">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd">
                                </path>
                            </svg>
                        </button>
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center lg:mr-8">
                            <x-logo.full />
                        </div>
                    </div>

                    <x-landingpage.desktop-menu></x-landingpage.desktop-menu>

                    <ul class="flex items-center ml-6 list-none">
                        <!-- Settings Dropdown -->
                        @auth
                        <li class="dropdown-notification mr-3">
                            @livewire('mahasiswa.notification')
                        </li>
                        <x-dashboard.header-profile />
                        @else
                        <div class="flex">
                            <x-anchor.primary href="{{ route('login') }}" class=" font-semibold font-poppins">
                                Login
                            </x-anchor.primary>
                        </div>
                        @endauth
                    </ul>
                </div>
                <x-landingpage.mobile-menu></x-landingpage.mobile-menu>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <footer class="bg-white border-t shadow-md  font-poppins">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-7">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <div class="flex items-center justify-center lg:justify-start my-4">
                        <!-- Logo -->
                        <x-logo.full />
                    </div>
                    <div class="flex items-center gap-4 justify-center my-4">
                        <!-- social -->
                        <a class="text-main hover:text-orange-500" href="mailto:pengurus-tingkat-4@stis.ac.id" role="button" target="blank" aria-label="email">
                            <x-icons.mail stroke-width="0" width="37" height="33" />
                        </a>
                        <a class="text-main hover:text-orange-500" href="https://instagram.com/stis60/" role="button" target="blank" aria-label="instagram">
                            <x-icons.instagram stroke-width="0" width="33" height="33" />
                        </a>
                        <a class="text-main hover:text-orange-500" href="https://youtube.com/c/POLSTATSTIS60" role="button" target="blank" aria-label="youtube">
                            <x-icons.youtube stroke-width="0" width="37" height="33" />
                        </a>
                    </div>
                    <div class="flex items-center lg:col-span-1 md:col-span-2 my-4">
                        <!-- copyright -->
                        <div class="text-center lg:text-right w-full">Copyright &copy; TI - Kembang 2022</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('modals')
    <div class="modal-center">
        @livewire('livewire-ui-modal')
    </div>

    <div class="fixed bottom-10 sm:right-10 right-5 transform sm:scale-100 scale-90" x-data="{show : false, showButton : () => document.body.scrollTop > 500 || document.documentElement.scrollTop > 500}" x-on:scroll.window="show = showButton()" x-init="show = showButton()" x-cloak>
        <div class="grid grid-cols-1 gap-y-1">
            @stack('bottom-menu')

            <div class="h-12 w-12 bg-main rounded-full border-2 border-white" id="scroll-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" x-show="show" x-transition x-transition.duration.600ms>
                <div class="relative flex justify-center items-center h-full w-full cursor-pointer">
                    <x-icons.arrow-up class="text-white hover:text-orange-200 transition duration-150" stroke-width='3' />
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="{{ mix('js/livewire-handler.js') }}"></script>
    @stack('scripts')
</body>

</html>