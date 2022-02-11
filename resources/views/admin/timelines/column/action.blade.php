<div class="flex justify-center">
    <x-button.icon.edit title="Update Timeline"
        onclick="Livewire.emit('openModal', 'admin.timelines.modal-add-edit', {{ json_encode(['timeline_id' => $timeline->id]) }})" />

    <x-button.icon.delete title="Delete Timeline"
        onclick="Livewire.emit('openModal', 'admin.timelines.modal-delete', {{ json_encode(['timeline_id' => $timeline->id]) }})" />

</div>
