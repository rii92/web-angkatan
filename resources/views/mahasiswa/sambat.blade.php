<x-dashboard-layout title="Sambat">
    <x-card.base title="Daftar Sambat">
        @slot('aside')
            <div class="flex items-center">
                <x-link class="text-xs italic mr-2" href="{{ route('sambat') }}">Halaman Sambat</x-link>
                <x-icons.refresh
                    class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180 mr-2"
                    onclick="Livewire.emit('reloadComponents', 'mahasiswa.sambat.table')" />
                <x-anchor.success href="{{ route('user.sambat.add') }}">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 hidden lg:block">Nyambat</span>
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
