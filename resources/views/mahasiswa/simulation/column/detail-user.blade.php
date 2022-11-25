<div class="flex justify-center">
    <x-button.icon.detail title="Detail Mahasiswa"
        onclick="Livewire.emit('openModal', 'mahasiswa.simulation.user-detail', {{ json_encode(['user_formation_id' => $user_formation->id]) }})" />
</div>
