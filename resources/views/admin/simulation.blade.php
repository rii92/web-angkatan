<x-dashboard-layout title="Simulation">
    <x-card.base title="Simulations List">
        @slot('aside')
            <div class="flex items-center">
                <x-button.success onclick="Livewire.emit('openModal', 'admin.simulation.modal-add-edit')">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 hidden lg:block">Simulation</span>
                </x-button.success>
            </div>
        @endslot
        @livewire('admin.simulation.table')
    </x-card.base>
</x-dashboard-layout>
