<div class="flex justify-center">
    <x-button.icon.setting
        onclick="Livewire.emit('openModal', 'admin.users.modal-role', {{ json_encode(['user_id' => $user->id]) }})" />
</div>
