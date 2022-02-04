<div class="flex justify-center">

    @if (in_array($turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REVISI_LINK]))
        <x-icons.pencil-alt stroke-width="2.0" width="22" height="22" onclick="Livewire.emit('openModal', 'mahasiswa.turnitin.modal-add-edit' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" class="text-green-600 cursor-pointer" />
    @endif

    <x-icons.annotation stroke-width="2.0" width="22" height="22" onclick="Livewire.emit('openModal', 'activity.turnitin' ,
    {{ json_encode(['turnitin_id' => $turnitin->id, 'isAdmin' => false]) }})"
        class="text-blue-600 cursor-pointer ml-2" />


    @if (in_array($turnitin->status, [AppTurnitins::STATUS_WAIT, AppTurnitins::STATUS_REJECT]))
        <x-icons.trash onclick="Livewire.emit('openModal', 'mahasiswa.turnitin.modal-delete' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" class="text-red-600 cursor-pointer ml-2" />
    @endif


</div>
