<div class="flex justify-center">
    <x-anchor.success class="ml-2" href="{{ route('admin.announcement.edit', $announcement) }}">
        Edit
    </x-anchor.success>
    <x-button.error class="ml-2"
        onclick="Livewire.emit('openModal', 'admin.announcement.modal-delete', {{ json_encode(['announcement_id' => $announcement->id]) }})">
        <span>Delete</span>
    </x-button.error>
</div>
