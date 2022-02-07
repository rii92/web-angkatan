<div>
    @if ($hasKonsulPublish)
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-12 md:gap-x-3 gap-x-1 gap-y-0 items-center">
                <div class="md:col-span-2 col-span-6 md:mb-0 mb-2 mt-0">
                    <x-input.select wire:model="category">
                        <option value>Semua Tipe</option>
                        <option value="{{ AppKonsul::TYPE_AKADEMIK }}">{{ ucfirst(AppKonsul::TYPE_AKADEMIK) }}
                        </option>
                        <option value="{{ AppKonsul::TYPE_UMUM }}">{{ ucfirst(AppKonsul::TYPE_UMUM) }}</option>
                    </x-input.select>
                </div>

                <div class="md:col-span-2 col-span-6 md:mb-0 mb-2 mt-0">
                    <x-input.select wire:model="jurusan">
                        <option value>Semua Jurusan</option>
                        @foreach (AppKonsul::allJurusan() as $jurusan)
                            <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                        @endforeach
                    </x-input.select>
                </div>

                <div class="md:col-span-8 col-span-12 mb-0 mt-0">
                    <x-input.text autocomplete="off" id="search" x-model="search" wire:model.debounce.700ms="search"
                        placeholder="Awali dengan # jika ingin mencari berdasarkan hastags.." />
                </div>
            </div>
            {!! $searchInfo !!}
        </div>


        <div class="mt-8 max-w-5xl mx-auto">
            @forelse ($konsuls as $konsul)
                <x-konsultasi.list-guest :konsul="$konsul" />
            @empty
                <p class="text-center md:text-lg leading-snug text-md mx-7">
                    Konsultasi yang kamu cari tidak ditemukan. Kamu lagi punya masalah dan belum dapat solusinya? Ayo
                    ceritakan ke kami baik masalah <x-link href="{{ route('user.konsultasi.akademik.add') }}">
                        akademik</x-link> ataupun <x-link href="{{ route('user.konsultasi.umum.add') }}">
                        yang lainnya</x-link>. Jika kamu malu, kamu bisa
                    pakai fitur anonim dan kami menjamin kerahasiaan identitasmu.
                </p>
            @endforelse
        </div>
    @else
        <div class="max-w-5xl mx-auto">
            <p class="text-center md:text-lg leading-snug text-md mx-7">
                Belum terdapat konsultasi yang dipublish. Jika kamu punya konsultasi yang sudah selesai, ayo segera di
                publish mungkin saja ada orang lain yang memiliki masalah yang sama. Atau sekarang kamu ada masalah? Ga
                perlu sungkan untuk menceritakan masalah <x-link href="{{ route('user.konsultasi.akademik.add') }}">
                    akademik</x-link> ataupun <x-link href="{{ route('user.konsultasi.umum.add') }}">
                    hidupmu</x-link> ke kami. Jika kamu malu, kamu bisa
                pakai fitur anonim dan kami menjamin kerahasiaan identitasmu.
            </p>
        </div>
    @endif
</div>
