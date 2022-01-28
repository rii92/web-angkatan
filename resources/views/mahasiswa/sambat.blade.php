<x-dashboard-layout title="Sambat">
    @livewire('sambat.table', ['user_id' => auth()->id()])
</x-dashboard-layout>