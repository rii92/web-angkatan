<div class="flex justify-end">
    <x-button.white
        onclick="Livewire.emit('openModal', 'users.modal-role', {{ json_encode(['user_id' => $user->id]) }})">
        <x-icons.settings width="16" height="16" stroke-width="2" />
    </x-button.white>
</div>
