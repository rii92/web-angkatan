<x-dashboard-layout title="Sambat">
    <x-card.base title="Daftar Sambat">
        @slot('aside')
            <div class="flex items-center">
                <x-anchor.success href="{{ route('user.sambat.add') }}">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2">Nyambat</span>
                </x-anchor.success>
            </div>
        @endslot

        @livewire('mahasiswa.sambat.table')
    </x-card.base>

    @push('scripts')
        <script src="{{ mix('js/viewer.js') }}" defer></script>
        <script src="{{ mix('js/sambat.js') }}" defer></script>
    @endpush
</x-dashboard-layout>
