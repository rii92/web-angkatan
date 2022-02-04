<x-app-layout title="Proker">
    <div class="py-6 bg-light-4 bg-gradient-to-t from-light-4 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="py-10">
                <div class="font-poppins font-bold text-4xl text-center text-main">
                    Program Kerja
                </div>
                <div class="font-holiday-free text-xl text-center mb-2 text-orange-500">
                    Kabinet Enam Puluh Berkembang
                </div>
            </h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 fadeInUp animate">
                @foreach (AppProker::all() as $key => $proker)
                    <div data-aos="fade-up" data-aos-duration="1000" class="proker"
                        onclick="Livewire.emit('openModal', 'guest.proker.modal-proker', {{ json_encode(['proker_index' => $key]) }})">
                        <img src="{{ asset($proker['src']) }}" alt="{{ $proker['title'] }}" />
                        <div class="proker-hover">
                            <div class="proker-hover-inner">
                                <h3 class="relative text-white text-xl font-semibold">{{ $proker['title'] }}</h3>
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
