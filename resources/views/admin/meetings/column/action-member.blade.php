<div class="flex justify-center">
    <x-button.black class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-edit-member', {{ json_encode(['meeting_member_id' => $meeting_member->id]) }})">
        <span>Update</span>
    </x-button.black>
</div>
