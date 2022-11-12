<div class="flex justify-center">
    <x-button.icon.edit title="Update Rapat"
        onclick="Livewire.emit('openModal', 'admin.simulasi.satker.modal-add-edit', {{ json_encode(['satker_id' => $satker->id]) }})" />
    <x-button.icon.delete title="Delete Rapat"
        onclick="Livewire.emit('openModal', 'admin.simulasi.satker.modal-delete', {{ json_encode(['satker_id' => $satker->id]) }})" />
</div>
