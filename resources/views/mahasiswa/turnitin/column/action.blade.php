<div class="flex justify-center">

    @if (in_array($turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REVISI_LINK]))
        <x-button.icon.edit title="Update Pengajuan" onclick="Livewire.emit('openModal', 'mahasiswa.turnitin.modal-add-edit' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" />
    @endif

    <x-button.icon.activity title="Riwayat Pengajuan" onclick="Livewire.emit('openModal', 'activity.turnitin' ,
    {{ json_encode(['turnitin_id' => $turnitin->id, 'isAdmin' => false]) }})" />


    @if (in_array($turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REJECT]))
        <x-button.icon.delete title="Delete Pengajuan" onclick="Livewire.emit('openModal', 'mahasiswa.turnitin.modal-delete' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" />
    @endif


</div>
