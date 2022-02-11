<div class="flex justify-center">
    <x-button.icon.setting title="Edit Status"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-edit-member', {{ json_encode(['meeting_member_id' => $meeting_member->id]) }})" />
</div>
