<div class="flex justify-center">
    <x-button.icon.form title="Form Rapat" href="{{ route('form', $meeting->token) }}" target="_blank" />
    <x-button.icon.detail title="Detail Rapat" href="{{ route('admin.meetings.details', $meeting->id) }}" />
    <x-button.icon.edit title="Update Rapat"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-add-edit', {{ json_encode(['meeting_id' => $meeting->id]) }})" />
    <x-button.icon.delete title="Delete Rapat"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-delete', {{ json_encode(['meeting_id' => $meeting->id]) }})" />
</div>
