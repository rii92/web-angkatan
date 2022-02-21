<x-dashboard-layout title="{{ $category == AppKonsul::TYPE_AKADEMIK ? 'Konsultasi Akademik' : 'Konsultasi Umum' }}">
    <x-card.base title="Konsultasi List">
        @slot('aside')
            <div class="flex items-center">
                <x-icons.refresh
                    class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180 mr-2"
                    onclick="Livewire.emit('reloadComponents', 'mahasiswa.konsultasi.table')" />
                <x-anchor.success href="{{ route('user.konsultasi.' . $category . '.add') }}">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 hidden lg:block">Konsultasi {{ ucwords($category) }}</span>
                </x-anchor.success>
            </div>
        @endslot

        @livewire('mahasiswa.konsultasi.table', ['category'=> $category])

        <p class="text-gray-400 text-sm mt-3 leading-tight">
            Data konsultasi masih dapat kamu edit dan hapus selama statusnya masih
            <x-badge.warning text="{{ AppKonsul::STATUS_WAIT }}" class="mr-0" />Jika statusnya sudah
            berubah maka hanya konselor yang bisa menghapusnya
        </p>

    </x-card.base>
</x-dashboard-layout>
