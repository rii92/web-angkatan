<div>
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <x-input.text autocomplete="off" id="search" x-model="search" wire:model.debounce.700ms="search"
                placeholder="Awali dengan # jika ingin mencari berdasarkan hashtags..." />
        </div>

        {!! $searchInfo !!}

        @forelse ($sambats as $sambat)
            @livewire('guest.sambat.item', ['sambat' => $sambat], key($sambat->id))
        @empty
            <div class="max-w-5xl mx-auto">
                <p class="text-center md:text-lg leading-snug text-md mx-7">
                    Lagi stress? Tertekan? Bosan kerjain skripsi? Yook sambatin aja <x-link
                        href="{{ route('user.sambat.add') }}">
                        disini</x-link>. Jika kamu malu, kamu bisa pakai fitur anonim dan kami menjamin kerahasiaan
                    identitasmu.
                </p>
            </div>
        @endforelse
        <div class="my-4" id="sambat-pagination">
            {{ $sambats->links('pagination.dark') }}
        </div>
    </div>
</div>
