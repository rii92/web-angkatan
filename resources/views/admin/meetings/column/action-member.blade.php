<div class="flex justify-center">
    <x-button.white class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-edit-member', {{ json_encode(['meeting_member_id' => $meeting_member->id]) }})">
        <x-icons.settings width="16" height="16" stroke-width="2" />
    </x-button.white>
</div>
