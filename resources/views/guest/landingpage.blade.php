<x-app-layout title="Web Angkatan 60">
    <header class="relative">
        <x-landingpage.hero />
    </header>

    {{-- Fasilitas --}}
    <section>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-landingpage.fasilitas href="{{ route('konsultasi') }}" title="Konsultasi">
                    <x-slot name="icon">
                        <x-icons.chat stroke-width=".5" width="70" height="70" />
                    </x-slot>
                    <x-slot name="description">Kamu kenapa ? Sini dong cerita, siapa tau bisa bantu.</x-slot>
                </x-landingpage.fasilitas>

                <x-landingpage.fasilitas href="{{ route('sambat') }}" title="Sambat">
                    <x-slot name="icon">
                        <x-icons.emoji-sad stroke-width=".5" width="70" height="70" />
                    </x-slot>
                    <x-slot name="description">Sudahi skripsimu, mari sambat bersamaku. Jangan lupa sambat.</x-slot>
                </x-landingpage.fasilitas>

                <x-landingpage.fasilitas href="{{ route('announcement') }}" title="Informasi">
                    <x-slot name="icon">
                        <x-icons.speakerphone stroke-width=".5" width="70" height="70" />
                    </x-slot>
                    <x-slot name="description">Ada info apa nih hari ini ? Yuk di cek, jangan sampai kudet.</x-slot>
                </x-landingpage.fasilitas>
            </div>
        </div>
    </section>
    {{-- Akhir dari fasilitas --}}


    @if (App::environment(['local', 'development']))
    <!-- program kerja -->
    <section>
        <div class="bg-main py-16">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-center font-bold font-poppins text-white tracking-wider mb-14">
                    <div class="text-3xl mb-1">PROGRAM KERJA</div>
                    <div class="text-xl">PENGURUS TINGKAT IV - 2021/2022
                </h2>
                <div class="swiper prokerSwiper">
                    <div class="swiper-wrapper mb-16">
                        @foreach (AppProker::all() as $proker)
                        <x-landingpage.proker title="{{ $proker['title'] }}" src="{{ $proker['src'] }}" description="{{ $proker['description'] }}" />
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir program kerja -->
        <!-- timeline -->
        <section>
            <div class="bg-white py-16">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h2 class="text-center font-bold font-poppins tracking-wider">
                        <div class="text-3xl mb-1">TIMELINE KEGIATAN</div>
                        <div class="text-xl">TINGKAT IV ANGKATAN 60 - 2021/2022 </div>
                    </h2>
                </div>

                <div class="mt-10">
                    @livewire('guest.landing.timeline')
                </div>
            </div>
        </div>
    </section>
    <!-- akhir timeline -->
    @endif

    @push('scripts')
    <script src="{{ mix('js/aos.js') }}" defer></script>
    <script src="{{ mix('js/swiper.js') }}" defer></script>
    @endpush
</x-app-layout>