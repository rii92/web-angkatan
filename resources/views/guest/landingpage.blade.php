<x-app-layout title="Web Angkatan 61">
    <header class="relative">
        <x-landingpage.hero />
    </header>

    <!-- program kerja -->
    <section>
        <div class="py-16 bg-main">
            <div class="px-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h2 class="font-bold tracking-wider text-center text-white font-poppins mb-14">
                    <div class="mb-1 text-3xl">PROGRAM KERJA</div>
                    <div class="text-lg md:text-xl">PENGURUS TINGKAT IV - 2021/2022
                </h2>
                <div class="swiper prokerImgSwiper">
                    <div class="mb-16 swiper-wrapper">
                        @foreach (AppProker::ProkerLanding() as $proker)
                            <div class="swiper-slide">
                                <img src="{{ $proker['src'] }}" alt="{{ $proker['title'] }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper prokerDescriptionSwiper">
                    <div class="mb-10 swiper-wrapper">
                        @foreach (AppProker::ProkerLanding() as $proker)
                            <div class="swiper-slide">
                                <div class="max-w-3xl m-auto text-center">
                                    <h3 class="mb-3 text-xl font-semibold text-orange-400 md:text-3xl font-poppins">
                                        {{ $proker['title'] }}</h3>
                                    <p class="mb-3 font-sans text-white md:texl-lg">{{ $proker['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center">
                    <x-anchor.primary href="{{ route('proker') }}"
                        class="transition-all duration-150 ease-in-out border-2 border-gray-300 button-medium hover:border-orange-500 hover:scale-110">
                        Selengkapnya
                    </x-anchor.primary>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir program kerja -->

    {{-- Fasilitas --}}
    <section class="hero61">
        <div class="max-w-5xl px-3 py-10 mx-auto sm:px-6 lg:px-8">

            {{-- Fitur Website --}}
            <h1>
                <div class="mt-20 text-6xl font-bold text-center text-black font-poppins mb-28">
                    FITUR WEBSITE
                </div>
            </h1>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                <x-landingpage.fasilitas href="{{ route('konsultasi.list') }}" title="Konsultasi">
                    <x-slot name="icon">
                        {{-- <x-icons.chat stroke-width=".5" width="70" height="70" /> --}}
                        <img src="/img/konsultasi.png" stroke-width=".5" width="70" height="70" alt="">
                    </x-slot>
                    <x-slot name="description">Kamu kenapa beb? Ayo cerita sini!</x-slot>
                </x-landingpage.fasilitas>

                <x-landingpage.fasilitas href="{{ route('sambat') }}" title="Sambat">
                    <x-slot name="icon">
                        {{-- <x-icons.emoji-sad stroke-width=".5" width="70" height="70" /> --}}
                        <img src="/img/konten.png" stroke-width=".5" width="70" height="70" alt="">
                    </x-slot>
                    <x-slot name="description">Anjazz kelazz! Sini lihat konten gua</x-slot>
                </x-landingpage.fasilitas>

                <x-landingpage.fasilitas href="{{ route('announcement') }}" title="Informasi">
                    <x-slot name="icon">
                        {{-- <x-icons.speakerphone stroke-width=".5" width="70" height="70" /> --}}
                        <img src="/img/informasi.png" stroke-width=".5" width="70" height="70" alt="">
                    </x-slot>
                    <x-slot name="description">Kamu nenyee? Sini ingpo maszzehh</x-slot>
                </x-landingpage.fasilitas>
            </div>
            {{-- Akhir Fitur Website --}}

            {{-- Quotes --}}
            <h1>
                <div class="mt-40 text-6xl font-bold text-center text-black font-poppins mb-28">
                    QUOTES AMBISHER
                </div>
                <div class="p-5 mt-20 text-4xl font-bold text-center text-black bg-grayQuotes backdrop-opacity-10 rounded-3xl font-poppins mb-28">
                    APA ITU AMBIS? ITU BUKANLAH AMBIS. ITU ADALAH KEBIASAANKU! 
                </div>
            </h1>
            {{-- Akhir Quotes --}}
        </div>
    </section>
    {{-- Akhir dari fasilitas --}}
    
    @push('scripts')
        <script src="{{ mix('js/aos.js') }}" defer></script>
        <script src="{{ mix('js/swiper.js') }}" defer></script>
    @endpush
</x-app-layout>
