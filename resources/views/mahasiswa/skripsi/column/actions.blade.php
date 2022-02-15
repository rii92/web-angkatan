<div class="flex justify-center">
    <x-button.icon.detail title="Detail Skripsi"
        onclick="Livewire.emit('openModal', 'mahasiswa.skripsi.modal-detail', {{ json_encode(['user_id' => $user->id]) }})" />
</div>
