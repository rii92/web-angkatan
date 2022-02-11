<div class="flex justify-center">
    <x-button.icon.chat title="Discussion Room"
        href="{{ route('admin.konsultasi.' . $konsul->category . '.room', $konsul->id) }}" class="relative">
        @if ($messageCount = $konsul->status == AppKonsul::STATUS_WAIT ? 1 : $konsul->unread_chats)
            <div
                class="absolute font-bold -right-2 -top-3 text-xs bg-orange-300 rounded-full w-6 h-6 flex justify-center items-center transform scale-75">
                {{ $messageCount }}
            </div>
        @endif
    </x-button.icon.chat>

    <x-button.icon.activity title="Riwayat Konsultasi"
        onclick="Livewire.emit('openModal', 'activity.konsultasi', {{ json_encode(['konsul_id' => $konsul->id]) }})" />

    @if ($konsul->status != AppKonsul::STATUS_WAIT)
        <x-button.icon.delete title="Delete Konsultasi" onclick="Livewire.emit('openModal', 'admin.konsultasi.modal-delete' ,
        {{ json_encode(['konsul_id' => $konsul->id, 'category' => $konsul->category]) }})" />
    @endif

</div>
