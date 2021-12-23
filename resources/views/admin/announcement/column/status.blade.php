<div class="flex justify-center">
    @if ($status == "Publish")
    <x-badge.success text="Publish" />
    @else
    <x-badge.warning text="Unpublish" class="cursor-pointer transform hover:scale-105 transition"
        onclick="Livewire.emit('openModal', 'admin.announcement.modal-publish-now', {{ json_encode(['announcement_id' => $id]) }})" />
    @endif
</div>
