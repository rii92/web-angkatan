<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ ucfirst($title) }} | {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/img/logo_angkatan.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/chat.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-archivo-narrow antialiased">
    <x-jet-banner />

    <div class="min-h-screen">
        <nav class="font-poppins shadow mb-2">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <x-logo.full />
                        </div>
                    </div>

                    <div class="flex items-center ml-6">
                        <!-- Settings Dropdown -->
                        @auth
                            @livewire('mahasiswa.notification')
                            <div class="ml-3 relative">
                                <x-jet-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}"
                                                alt="{{ Auth::user()->name }}" />
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-jet-dropdown-link href="{{ route('user') }}">
                                            {{ __('My Dashboard') }}
                                        </x-jet-dropdown-link>

                                        @can(AppPermissions::DASHBOARD_ACCESS)
                                            <x-jet-dropdown-link href="{{ route('admin.dashboard') }}">
                                                {{ __('Halaman Admin') }}
                                            </x-jet-dropdown-link>
                                        @endcan

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        @else
                            <div class="flex">
                                <x-anchor.primary href="{{ route('login') }}" class=" font-semibold font-poppins">
                                    Login
                                </x-anchor.primary>
                            </div>
                        @endauth
                    </div>
                </div>
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
                        <a class="text-main hover:text-orange-500" href="mailto:pengurus-tingkat-4@stis.ac.id"
                            role="button" target="blank" aria-label="email">
                            <x-icons.mail stroke-width="0" width="37" height="33" />
                        </a>
                        <a class="text-main hover:text-orange-500" href="https://instagram.com/stis60/" role="button"
                            target="blank" aria-label="instagram">
                            <x-icons.instagram stroke-width="0" width="33" height="33" />
                        </a>
                        <a class="text-main hover:text-orange-500" href="https://youtube.com/c/POLSTATSTIS60"
                            role="button" target="blank" aria-label="youtube">
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
    @livewire('livewire-ui-modal')
</body>

@livewireScripts
<script src="{{ mix('js/livewire-handler.js') }}"></script>
@stack('scripts')

</html>
