<div class="flex justify-center">
    <x-anchor.success class="ml-2" href="{{ route('admin.konsultasi.chat', $konsul) }}">
        Chat
    </x-anchor.success>
    <x-button.error class="ml-2"
        onclick="Livewire.emit('openModal', 'konsultasi.modal-delete', {{ json_encode(['konsul_id' => $konsul->id]) }})">
        <span>Delete</span>
    </x-button.error>
</div>
