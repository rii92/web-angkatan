<div>
    @if ($hasSambat)
        <div class="max-w-3xl mx-auto">
            <x-input.wrapper class="relative">
                <x-input.text wire:model="search" class="pl-8 pr-3" />
                <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                    <x-icons.search />
                </div>
            </x-input.wrapper>

            @foreach ($sambats as $sambat)
                @livewire('guest.sambat.item', ['sambat' => $sambat], key($sambat->id))
            @endforeach

            <div class="my-4" id="sambat-pagination">
                {{ $sambats->links('pagination.dark') }}
            </div>
        </div>
    @else
        <div class="max-w-5xl mx-auto">
            <p class="text-center md:text-lg leading-snug text-md mx-7">
                Lagi stress? Tertekan? Bosan kerjain skripsi? Yook sambatin aja <x-link
                    href="{{ route('user.sambat.add') }}">
                    disini</x-link>. Jika kamu malu, kamu bisa pakai fitur anonim dan kami menjamin kerahasiaan
                identitasmu.
            </p>
        </div>
    @endif
</div>
