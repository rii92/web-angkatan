<div class="flex justify-center">
    <x-button.icon.delete title="Delete Simulation"
        onclick="Livewire.emit('openModal', 'admin.simulation.modal-delete', {{ json_encode(['simulation_id' => $simulation->id]) }})" />

</div>
