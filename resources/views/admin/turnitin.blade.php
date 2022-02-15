<x-dashboard-layout title="Turnitin Submission">
    <x-card.base title="Submissions List">
        @slot('aside')
            <div class="flex items-center">
                <x-icons.refresh
                    class="text-gray-500 cursor-pointer transform transition-transform duration-1000 hover:rotate-180 mr-2"
                    onclick="Livewire.emit('reloadComponents', 'admin.turnitin.table')" />
            </div>
        @endslot
        @livewire('admin.turnitin.table')
    </x-card.base>
</x-dashboard-layout>
