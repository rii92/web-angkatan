<x-dashboard-layout title="Meeting Details">
    <x-card.base title="{{ $meeting->name }}">
        @slot('aside')
            <div class="flex items-center">
                <x-button.success onclick="Livewire.emit('openModal', 'admin.meetings.modal-add-member', {{ json_encode(['meeting_id' => $meeting->id]) }})">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2">Members</span>
                </x-button.success>
            </div>
        @endslot
        <div class="mb-4 text-sm">
            {{ $meeting->description }}
        </div>
        <div>
            @livewire('admin.meetings.table-member', ['meeting_id' => $meeting->id], key($meeting->id))
        </div>
    </x-card.base>
</x-dashboard-layout>
