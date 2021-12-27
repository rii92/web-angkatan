<div class="flex justify-center">
    <x-button.black class="ml-2"
        onclick="Livewire.emit('openModal', 'skripsi.modal-detail', {{ json_encode(['user_id' => $user->id]) }})">
        <span>Details</span>
    </x-button.black>
</div>
