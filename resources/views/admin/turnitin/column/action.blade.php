<div class="flex justify-center">

    @if ($turnitin->status != AppTurnitins::STATUS_REJECT)
        <x-button.icon.edit title="Update Pengajuan" onclick="Livewire.emit('openModal', 'admin.turnitin.modal-edit' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" />
    @endif

    <x-button.icon.activity title="Riwayat Pengajuan" onclick="Livewire.emit('openModal', 'activity.turnitin' ,
    {{ json_encode(['turnitin_id' => $turnitin->id, 'isAdmin' => true]) }})" />

    <x-button.icon.delete title="Delete Pengajuan" onclick="Livewire.emit('openModal', 'admin.turnitin.modal-delete' ,
    {{ json_encode(['turnitin_id' => $turnitin->id]) }})" />

</div>
