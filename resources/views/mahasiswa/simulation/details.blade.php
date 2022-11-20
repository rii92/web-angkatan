<x-dashboard-layout title="{{ $simulation->title }}">
    @livewire('mahasiswa.simulation.selection', ["simulation" => $simulation])
    <x-card.base title="Daftar Satker">
        @livewire('mahasiswa.simulation.satker-table', ["simulation_id" => $simulation->id])
    </x-card.base>
    <x-card.base title="Peserta Simulasi">
        @livewire('mahasiswa.simulation.users-table', ["simulation_id" => $simulation->id])
    </x-card.base>
</x-dashboard-layout>
