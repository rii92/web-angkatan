<x-dashboard-layout title="Timelines">
    <x-card.base title="Timelines List">
        @slot('aside')
            <div class="flex items-center">
                <x-button.success onclick="Livewire.emit('openModal', 'admin.timelines.modal-add-edit')">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2">Timeline</span>
                </x-button.success>
            </div>
        @endslot
        @livewire('admin.timelines.table')
    </x-card.base>
    <div class="mt-10">
        @livewire('homepage.landing.timeline')
    </div>
</x-dashboard-layout>
