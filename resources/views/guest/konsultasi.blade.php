@if (!isset($konsuls))
    <x-app-layout title="Konsultasi">
        @livewire('konsultasi.table')
    </x-app-layout>

@else

    <div class="max-w-5xl mx-auto">
        <x-card.base title="Konsultasi">
            @slot('aside')
                <div class="flex items-center">
                    @if ($user_id)
                        <x-anchor.black href="{{ route('konsultasi') }}">
                            <span class="ml-2 text-xs">View All</span>
                        </x-anchor.black>
                    @endif
                    <x-anchor.success href="{{ route('user.konsultasi.umum.table') }}" class="ml-2">
                        <x-icons.plus stroke-width="2.5" width="16" height="16" />
                        <span class="hidden md:inline-block ml-2 text-xs">Konsultasi Umum</span>
                    </x-anchor.success>
                    <x-anchor.success href="{{ route('user.konsultasi.akademik.table') }}" class="ml-2">
                        <x-icons.plus stroke-width="2.5" width="16" height="16" />
                        <span class="hidden md:inline-block ml-2 text-xs">Konsultasi Akademik</span>
                    </x-anchor.success>
                </div>
            @endslot
            <x-input.wrapper class="relative">
                <x-input.text wire:model="search" class="pl-8 pr-3" />
                <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                    <x-icons.search></x-icons.search>
                </div>
            </x-input.wrapper>
            @foreach ($konsuls as $konsul)
                @livewire('konsultasi.item', ['konsul' => $konsul], key($konsul->id))
                {{-- @dump($konsul->get()->toArray())<hr><br><hr> --}}
            @endforeach
            <div class="my-4">{{ $konsuls->links() }}</div>
        </x-card.base>

    </div>

@endif
