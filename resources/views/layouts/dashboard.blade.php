<!DOCTYPE html>
<html lang="en" x-data="initData()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title and descriptioan --}}
    <title>{{ ucfirst($title) }} | {{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/img/logo_angkatan.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100" :class="{ 'overflow-hidden': isSideMenuOpen }">
        @include('components.dashboard.sidebar')
        <div class="flex flex-col flex-1 overflow-x-hidden">
            <div class="z-10">
                @include('components.dashboard.header')
            </div>
            <main class="h-full overflow-y-auto">
                <div class="xl:container px-3 py-8 md:px-6 mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @livewire('livewire-ui-modal')
</body>
@livewireScripts
<script src="{{ mix('js/livewire-handler.js') }}"></script>
@stack('scripts')

</html>
