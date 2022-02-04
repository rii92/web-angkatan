<div class="flex justify-center">

    @if ($turnitin->status != AppTurnitins::STATUS_REJECT)
        <x-icons.pencil-alt stroke-width="2.0" width="22" height="22" onclick="Livewire.emit('openModal', 'admin.turnitin.modal-edit' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" class="text-green-600 cursor-pointer" />
    @endif

    <x-icons.annotation stroke-width="2.0" width="22" height="22" onclick="Livewire.emit('openModal', 'activity.turnitin' ,
    {{ json_encode(['turnitin_id' => $turnitin->id, 'isAdmin' => true]) }})"
        class="text-blue-600 cursor-pointer ml-2" />


    <x-icons.trash onclick="Livewire.emit('openModal', 'admin.turnitin.modal-delete' ,
        {{ json_encode(['turnitin_id' => $turnitin->id]) }})" class="text-red-600 cursor-pointer ml-2" />

</div>
