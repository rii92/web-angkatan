<x-dashboard-layout title="Turnitin Submission">
    <x-card.base title="Submissions List">
        @slot('aside')
            <div class="flex items-center">
                <x-icons.refresh
                    class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180 mr-2"
                    onclick="Livewire.emit('reloadComponents', 'mahasiswa.turnitin.table')" />
                <x-button.success onclick="Livewire.emit('openModal', 'mahasiswa.turnitin.modal-add-edit')">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 hidden lg:block">Submission</span>
                </x-button.success>
            </div>
        @endslot
        @livewire('mahasiswa.turnitin.table')

        <p class="text-gray-400 text-sm mt-3 leading-tight">
            Pengajuan turnitin masih dapat kamu edit dan hapus selama statusnya masih
            <x-badge.warning text="{{ ucwords(AppTurnitins::STATUS_WAIT) }}" class="mr-0" />
            Jika statusnya sudah
            berubah maka hanya admin yang bisa menghapusnya. Jika statusnya
            <x-badge.secondary text="{{ ucwords(AppTurnitins::STATUS_REVISI_LINK) }}" class="mr-0" /> maka
            perhatikan
            keterangan yang berada di menu
            <x-icons.annotation class="inline-block text-blue-600" />
        </p>
    </x-card.base>
</x-dashboard-layout>
