<x-app-layout title="Proker">
    <div class="min-h-screen py-6 bg-light-4 bg-gradient-to-t from-light-4 to-white">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1>
                    <div class="text-6xl font-bold text-center text-black font-poppins">
                        Program Kerja
                    </div>
                </h1>
                <hr class="max-w-lg mx-auto border-2 border-black w-80 md:w-2/4" />
                <p class="px-5 mx-auto text-3xl font-extrabold text-center font-beach-sound text-font-color-sub">
                    Polstat STIS Angkatan 61
                </p>
            </div>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 fadeInUp animate">
                @foreach (AppProker::all() as $key => $proker)
                <div data-aos="fade-up" data-aos-duration="1000" class="proker"
                    onclick="Livewire.emit('openModal', 'guest.proker.modal-proker', {{ json_encode(['proker_index' => $key]) }})">
                    <img src="{{ asset($proker['src']) }}" alt="{{ $proker['title'] }}" />
                    <div class="proker-hover">
                        <div class="proker-hover-inner">
                            <h3 class="relative text-xl font-semibold text-white">{{ $proker['title'] }}</h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ mix('js/aos.js') }}" defer></script>
    @endpush
</x-app-layout>
