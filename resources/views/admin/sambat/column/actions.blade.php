<div class="flex justify-center">
    <x-button.black class="ml-2"
        onclick="Livewire.emit('openModal', 'guest.sambat.modal-detail', {{ json_encode(['sambat_id' => $sambat->id]) }})">
        <span>Details</span>
    </x-button.black>
</div>
