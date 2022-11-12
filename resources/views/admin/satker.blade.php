<x-dashboard-layout title="Daftar Formasi Satker">
    <x-card.base title="Satuan Kerja">
        @slot('aside')
            <div class="flex items-center">
                <x-button.success onclick="Livewire.emit('openModal', 'admin.satker.modal-add-edit')">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 text-xs hidden lg:block">Satker</span>
                </x-button.success>
            </div>
        @endslot
        @livewire('admin.satker.table')
    </x-card.base>
</x-dashboard-layout>
