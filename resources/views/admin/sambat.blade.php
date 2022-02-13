<x-dashboard-layout title="Sambat">
    <x-card.base title="Daftar Sambat">
        @livewire('admin.sambat.table')
    </x-card.base>

    @push('scripts')
        <script src="{{ mix('js/viewer.js') }}" defer></script>
        <script src="{{ mix('js/sambat.js') }}" defer></script>
    @endpush
</x-dashboard-layout>
