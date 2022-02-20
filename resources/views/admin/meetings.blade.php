<x-dashboard-layout title="Meetings">
    <x-card.base title="Meetings List">
        @slot('aside')
            <div class="flex items-center">
                <x-button.success onclick="Livewire.emit('openModal', 'admin.meetings.modal-add-edit')">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 hidden lg:block">Meetings</span>
                </x-button.success>
            </div>
        @endslot
        @livewire('admin.meetings.table')
    </x-card.base>
</x-dashboard-layout>
