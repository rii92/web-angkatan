<div class="max-w-3xl mx-auto">
    <x-input.wrapper class="relative">
        <x-input.text wire:model="search" class="pl-8 pr-3" />
        <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
            <x-icons.search />
        </div>
    </x-input.wrapper>

    @foreach ($sambats as $sambat)
        @livewire('guest.sambat.item', ['sambat' => $sambat, 'indexComponent' => $loop->index], key($sambat->id))
    @endforeach

    <div class="my-4" id="sambat-pagination">
        {{ $sambats->links('pagination.dark') }}
    </div>
</div>
