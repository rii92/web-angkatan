<div class="flex justify-center">
    <x-button.black class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.timelines.modal-add-edit', {{ json_encode(['timeline_id' => $timeline->id]) }})">
        <span>Update</span>
    </x-button.black>
    <x-button.error class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.timelines.modal-delete', {{ json_encode(['timeline_id' => $timeline->id]) }})">
        <span>Delete</span>
    </x-button.error>
</div>
