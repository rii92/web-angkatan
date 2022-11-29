<div class="flex justify-center">
    <x-button.icon.edit title="Update Simulation"
        onclick="Livewire.emit('openModal', 'admin.simulation.modal-add-edit', {{ json_encode(['simulation_id' => $simulation->id]) }})" />

    <x-button.icon.delete title="Delete Simulation"
        onclick="Livewire.emit('openModal', 'admin.simulation.modal-delete', {{ json_encode(['simulation_id' => $simulation->id]) }})" />

</div>
