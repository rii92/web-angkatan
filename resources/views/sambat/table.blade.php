<div class="max-w-5xl mx-auto">
    <x-card.base title="sambat">
        @slot('aside')
            <x-anchor.success href="{{ route('user.sambat.add') }}">
                <x-icons.plus stroke-width="2.5" width="16" height="16" />
                <span class="ml-2">Buat Sambat</span>
            </x-anchor.success>
        @endslot
        <x-input.wrapper class="relative">
            <x-input.text wire:model="search" class="pl-8 pr-3" />
            <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                <x-icons.search></x-icons.search>
            </div>
        </x-input.wrapper>
        @foreach ($sambats as $sambat)
            @livewire('sambat.item', ['sambat' => $sambat], key($sambat->id))
        @endforeach
        <div class="my-4">{{ $sambats->links() }}</div>
    </x-card.base>
    
</div>
