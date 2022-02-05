<div class="flex justify-center">
    <x-konsultasi.icon-chat href="{{ route('admin.konsultasi.' . $konsul->category . '.room', $konsul->id) }}"
        messageCount="{{ $konsul->status == AppKonsul::STATUS_WAIT ? 1 : $konsul->unread_chats }}" />

    @if ($konsul->status != AppKonsul::STATUS_WAIT)
        <x-konsultasi.icon-delete onclick="Livewire.emit('openModal', 'admin.konsultasi.modal-delete' ,
    {{ json_encode(['konsul_id' => $konsul->id, 'category' => $konsul->category]) }})" />
    @endif

</div>
