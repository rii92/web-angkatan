<div class="flex justify-end">
    <x-button.white
        onclick="Livewire.emit('openModal', 'admin.roles.modal-permission', {{ json_encode(['role_id' => $role->id]) }})">
        <x-icons.settings width="16" height="16" stroke-width="2" />
    </x-button.white>
</div>
