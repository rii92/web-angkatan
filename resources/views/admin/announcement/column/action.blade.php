<div class="flex justify-center">
    <x-button.icon.edit title="Update Pengumuman" href="{{ route('admin.announcement.edit', $announcement) }}" />
    <x-button.icon.delete title="Delete Pengumuman"
        onclick="Livewire.emit('openModal', 'admin.announcement.modal-delete', {{ json_encode(['announcement_id' => $announcement->id]) }})" />
</div>
