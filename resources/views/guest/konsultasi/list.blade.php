<div>
    <form wire:submit.prevent="handleSearch">
        <div class="grid grid-cols-12 md:gap-x-3 gap-x-1 gap-y-0 items-center max-w-6xl mx-auto">
            <div class="md:col-span-2 col-span-6 md:mb-0 mb-2 mt-0">
                <x-input.select wire:model="category">
                    <option value="all">Semua Tipe</option>
                    <option value="{{ AppKonsul::TYPE_AKADEMIK }}">{{ ucfirst(AppKonsul::TYPE_AKADEMIK) }}</option>
                    <option value="{{ AppKonsul::TYPE_UMUM }}">{{ ucfirst(AppKonsul::TYPE_UMUM) }}</option>
                </x-input.select>
            </div>

            <div class="md:col-span-2 col-span-6 md:mb-0 mb-2 mt-0">
                <x-input.select wire:model="jurusan">
                    <option value="all">Semua Jurusan</option>
                    @foreach (AppKonsul::allJurusan() as $jurusan)
                        <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                    @endforeach
                </x-input.select>
            </div>

            <div class="lg:col-span-7 md:col-span-6 col-span-9 mb-0 mt-0">
                <x-input.text autocomplete="off" id="search" wire:model="search"
                    placeholder="Awali dengan # jika ingin mencari berdasarkan hastags.." />
            </div>

            <div class="lg:col-span-1 md:col-span-2 col-span-3">
                <x-button.black type="submit" class="flex justify-center w-full">Cari</x-button.black>
            </div>
        </div>
    </form>

    <div class="mt-8 max-w-5xl mx-auto">
        @foreach ($konsuls as $konsul)
            @php
                $photo = $konsul->is_anonim ? 'https://ui-avatars.com/api/?name=Anonim&color=7F9CF5&background=EBF4FF' : $konsul->user->profile_photo_url;
                $name = $konsul->is_anonim ? 'Anonim' : $konsul->user->name;
                $kelas = $konsul->is_anonim ? "Jurusan {$konsul->userdetails->jurusan}" : "{$konsul->userdetails->nim}/{$konsul->userdetails->kelas}";
            @endphp

            <div class="mb-8">
                <div class="flex items-center">
                    <img src="{{ $photo }}" alt="{{ $name }}"
                        class="rounded-full mr-3 border border-gray-200 shadow-md sm:h-12 sm:w-12 w-10 h-10">
                    <div class="flex flex-col">
                        <h2 class="leading-tight md:text-2xl text-lg">
                            {{ $konsul->title }}
                            <x-konsultasi.category category="{{ $konsul->category }}" />
                        </h2>
                        <small class="text-gray-500">{{ $name }} | {{ $kelas }} |
                            {{ $konsul->published_at->format('d M Y H:i') }}</small>
                    </div>
                </div>

                <div class="bg-light-4 bg-opacity-30 p-5 rounded-lg mt-3 shadow-lg border border-gray-300">
                    <article class="text-gray-800">
                        {{ Str::limit(strip_tags(Str::markdown($konsul->description)), 1500, '...') }}
                    </article>
                    <div class="flex justify-between items-center mt-3">
                        <div>
                            @foreach ($konsul->tags as $tag)
                                <x-badge.success text="{{ $tag->name }}" class="mr-0" />
                            @endforeach
                        </div>
                        <x-anchor.black class="ml-3"
                            href="{{ route('konsultasi.detail', ['slug' => $konsul->slug]) }}">Lihat
                        </x-anchor.black>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
