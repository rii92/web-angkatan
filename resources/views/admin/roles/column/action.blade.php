<div class="flex justify-center">
    <x-button.icon.setting
        onclick="Livewire.emit('openModal', 'admin.roles.modal-permission', {{ json_encode(['role_id' => $role->id]) }})" />
</div>
