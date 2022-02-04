<div class="flex justify-center">
    <x-konsultasi.icon-chat href='{{ route("user.konsultasi.{$konsul->category}.room", $konsul->id) }}'
        messageCount="{{ $konsul->unread_chats }}" />

    @if ($konsul->status == AppKonsul::STATUS_WAIT)
        <a href='{{ route("user.konsultasi.{$konsul->category}.edit", $konsul->id) }}' class="text-green-600 ml-2">
            <x-icons.pencil-alt stroke-width="2.0" width="22" height="22" />
        </a>

        <x-konsultasi.icon-delete onclick="Livewire.emit('openModal', 'mahasiswa.konsultasi.modal-delete' ,
        {{ json_encode(['konsul_id' => $konsul->id]) }})" />
    @endif

    @if ($konsul->status == AppKonsul::STATUS_REJECT)
        <x-konsultasi.icon-delete onclick="Livewire.emit('openModal', 'mahasiswa.konsultasi.modal-delete' ,
        {{ json_encode(['konsul_id' => $konsul->id]) }})" />
    @endif
</div>
