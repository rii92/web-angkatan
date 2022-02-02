<x-dashboard-layout title="{{ $category == AppKonsul::TYPE_AKADEMIK ? 'Konsultasi Akademik' : 'Konsultasi Umum' }}">
    <x-card.base title="Konsultasi List">
        @slot('aside')
            <div class="flex items-center">
                <x-icons.refresh
                    class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180 mr-2"
                    onclick="Livewire.emit('reloadComponents', 'admin.konsultasi.table')" />
            </div>
        @endslot
        
        @livewire('admin.konsultasi.table', ['category'=> $category])
    </x-card.base>
</x-dashboard-layout>
