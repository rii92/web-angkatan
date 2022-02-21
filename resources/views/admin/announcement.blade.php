<x-dashboard-layout title="Announcement">
    <x-card.base title="Announcement List">
        @slot('aside')
            <div class="flex items-center">
                <x-anchor.success href="{{ route('admin.announcement.add') }}">
                    <x-icons.plus stroke-width="2.5" width="16" height="16" />
                    <span class="ml-2 hidden lg:block">Announcement</span>
                </x-anchor.success>
            </div>
        @endslot
        @livewire('admin.announcement.table')

        @if (session('message'))
            @push('scripts')
                <script>
                    Livewire.emit('success', "{{ session('message') }}")
                </script>
            @endpush
        @endif
    </x-card.base>
</x-dashboard-layout>
