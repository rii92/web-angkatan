<div class="flex justify-center">
    <x-button.icon.detail title="Detail Sambat"
        onclick="Livewire.emit('openModal', 'guest.sambat.modal-detail', {{ json_encode(['sambat_id' => $sambat->id, 'route' => 'user']) }})" />
    <x-button.icon.edit title="Edit Sambat" href="{{ route('user.sambat.edit', ['sambat_id' => $sambat->id]) }}" />
    <x-button.icon.delete title="Hapus Sambat"
        onclick="Livewire.emit('openModal', 'guest.sambat.modal-delete', {{ json_encode(['sambat_id' => $sambat->id, 'route' => 'user']) }})" />
</div>
