<x-dashboard-layout title="Sambat">
    <x-card.base title="Daftar Sambat">
        @livewire('sambat.table', ['user_id' => auth()->id()])
    </x-card.base>
</x-dashboard-layout>