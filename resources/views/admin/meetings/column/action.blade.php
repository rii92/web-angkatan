<div class="flex justify-center">
    <x-anchor.success href="{{ route('form', $meeting->token) }}" target="_blank">
        Form
    </x-anchor.success>
    <x-anchor.black class="ml-2" href="{{ route('admin.meetings.details', $meeting->id) }}">
        Details
    </x-anchor.black>
    <x-button.white class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-add-edit', {{ json_encode(['meeting_id' => $meeting->id]) }})">
        <x-icons.settings width="16" height="16" stroke-width="2" />
    </x-button.white>
    <x-button.error class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.meetings.modal-delete', {{ json_encode(['meeting_id' => $meeting->id]) }})">
        <span>Delete</span>
    </x-button.error>
</div>
